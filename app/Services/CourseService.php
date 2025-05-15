<?php

namespace App\Services;

use App\DTOs\CourseDTO;
use App\Enums\CourseStatusEnum;
use App\Enums\RolesENUM;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class CourseService
{
    public const STEPS = ['Kerangka Utama', 'Isi Konten', 'Keuntungan & Pengumuman'];
    public const IS_PAID = ['Gratis', 'Bayar'];
    public const IS_CERTIFICATE = ['Tidak Ada', 'Ada'];
    private const ALLOWED_EXTENSIONS = ['jpg', 'jpeg', 'png', 'webp'];
    private const MAX_FILE_SIZE = 2048; // dalam kilobytes

    public static function isDPP() {
        return Auth::user()->regional_id === RolesENUM::DPP;
        // return Auth::user()->hasRole('dpp');
    }

    public function storeCourse(CourseDTO $dto, ?UploadedFile $file = null): Course
    {
        return DB::transaction(function () use ($dto, $file) {
            $course = Course::updateOrCreate(
                ['id' => $dto->model_id ?? null],
                (array) $dto
            );

            $this->handleLevels($course, $dto->levels);
            $this->handleCategories($course, $dto->categories);
            $this->handleProfessions($course, $dto->professions);
            $this->handleStudentTypes($course, $dto->studentTypes);
            // $this->handleContents($course, $dto->contents);
            $this->handleContactPersons($course, $dto->contactPersons);
            $this->handleCourseAdditionals($course, $dto->additionals);

            if ($file) {
                $this->handleFileUpload($course, $file, $dto->title);
            }

            return $course;
        });
    }

    private function handleLevels(Course $course, array $levels): void
    {
        $course->levels()->sync($levels);
    }

    private function handleCategories(Course $course, array $categories): void
    {
        $course->categories()->sync($categories);
    }

    private function handleProfessions(Course $course, array $professions): void
    {
        $course->professions()->sync($professions);
    }

    private function handleStudentTypes(Course $course, array $studentTypes): void
    {
        $course->studentTypes()->sync($studentTypes);
    }

    private function handleTargetParticipants(Course $course, array $targetParticipants): void
    {
        $course->targetParticipants()->delete();
        $course->targetParticipants()->createMany($targetParticipants);
    }

    private function handleContents(Course $course, array $contents): void
    {
        $course->courseContents()->delete();

        foreach ($contents as $content)
        {
            $contentSave = $course->courseContents()->create($content);

            $modules = collect($content['modules'])
                ->map(function($item) use($course) {
                    return array_merge($item, ['course_id' => $course->id]);
                });

            $contentSave->modules()->createMany($modules);
        }
    }

    private function handleContactPersons(Course $course, array $contactPersons): void
    {
        $course->contactPersons()->delete();
        $course->contactPersons()->createMany($contactPersons);
    }

    private function handleCourseAdditionals(Course $course, array $additionals): void
    {
        $course->courseAdditional()->updateOrCreate(['course_id' => $course->id], $additionals);
    }

    // private function prepareCourseData(object $data): array
    // {
    //     return [
    //         'title' => $data->title,
    //         'category_id' => $data->category_id,
    //         'price' => numericOnly($data->price),
    //         'wa_cs' => phoneNumberID(numericOnly($data->wa_cs)),
    //         'link_lms' => $data->link_lms ?? null,
    //         'description' => $data->description ?? null,
    //     ];
    // }

    private function handleFileUpload(Course $course, UploadedFile $file, string $title): void
    {
        try {
            $this->validateFile($file);

            // Generate nama file yang unik
            $fileName = $this->generateFileName($title, $file);

            // Hapus file lama jika ada
            $this->deleteExistingFile($course);

            // Upload file baru
            $course->addMedia($file)
                ->usingFileName($fileName)
                // ->withResponsiveImages()
                // ->withCustomProperties([
                //     'title' => $title,
                //     'uploaded_at' => now()
                // ])
                ->toMediaCollection(Course::IMAGE_COLLECTION);

        } catch (Exception $e) {
            Log::error('File upload failed', [
                'course_id' => $course->id,
                'error' => $e->getMessage()
            ]);
            throw new Exception('Gagal mengunggah file: ' . $e->getMessage());
        }
    }

    private function validateFile(UploadedFile $file): void
    {
        if (!in_array($file->getClientOriginalExtension(), self::ALLOWED_EXTENSIONS)) {
            throw new Exception('Format file tidak didukung. Format yang diizinkan: ' . implode(', ', self::ALLOWED_EXTENSIONS));
        }

        if ($file->getSize() > (self::MAX_FILE_SIZE * 1024)) {
            throw new Exception('Ukuran file terlalu besar. Maksimal ' . self::MAX_FILE_SIZE . 'KB');
        }
    }

    private function generateFileName(string $title, UploadedFile $file): string
    {
        $baseFileName = Str::slug($title);
        $extension = $file->getClientOriginalExtension();
        $timestamp = now()->timestamp;

        return "{$baseFileName}-{$timestamp}.{$extension}";
    }

    private function deleteExistingFile(Course $course): void
    {
        if ($course->hasMedia(Course::IMAGE_COLLECTION)) {
            $course->clearMediaCollection(Course::IMAGE_COLLECTION);
        }
    }

    // Helper method untuk mendapatkan URL gambar
    public function getCourseImageUrl(Course $course): ?string
    {
        return $course->hasMedia(Course::IMAGE_COLLECTION)
            ? $course->getFirstMediaUrl(Course::IMAGE_COLLECTION)
            : null;
    }

    // Helper method untuk mendapatkan thumbnail
    public function getCourseImageThumbnail(Course $course, int $width = 300, int $height = 200): ?string
    {
        if (!$course->hasMedia(Course::IMAGE_COLLECTION)) {
            return null;
        }

        return $course->getFirstMedia(Course::IMAGE_COLLECTION)
            ->getResponsiveImageUrl([
                'width' => $width,
                'height' => $height
            ]);
    }

    /**
     * Temukan course berdasarkan ID
     *
     * @param string $id
     * @return Course
     * @throws ModelNotFoundException
     */
    public function findOrFail(string $id): Course
    {
        return Course::with(['category', 'media', 'courseContents.modules', 'targetParticipants', 'contactPersons', 'courseAdditional'])
            ->findOrFail($id);
    }

    public function findByStatus(CourseStatusEnum $status): Collection
    {
        $userId = Auth::id();

        return Course::select(
                'id',
                'title',
                'user_id',
                'type_id',
                'start_at',
                'end_at',
            )
            ->with('user', 'type')
            ->where([
                ['status', $status],
                ['user_id', $userId]
            ])
            ->orderBy('updated_at')
            ->get();
    }

    public function deleteCourse(string $id): void
    {
        DB::transaction(function () use ($id) {
            $this->findOrFail($id)->delete();
        });
    }

    public function togglePublishStatus(string $id): void
    {
        DB::transaction(function () use ($id) {
            $course = $this->findOrFail($id);
            $course->update([
                'is_published' => !$course->is_published
            ]);
        });
    }

    public function courseStatus(int $statused = 0): CourseStatusEnum
    {
        $status = CourseStatusEnum::DRAFT;

        return $status;
    }
}
