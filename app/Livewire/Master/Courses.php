<?php

namespace App\Livewire\Master;

use App\Models\Course;
use App\Services\CourseService;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\DTOs\CourseDTO;
use App\Http\Requests\CourseRequest;
use App\Models\Traits\NotificationTypes;
use App\Services\CategoryService;
use Illuminate\Http\UploadedFile;
use App\Traits\{Loggable, WithNotification};
use App\Services\TagService;
use DateTime;

class Courses extends Component
{
    use AuthorizesRequests, WithFileUploads, NotificationTypes, Loggable, WithNotification;

    public string $meta_title = '';
    public string $showImageUrl = '';
    public array $categories = [];
    public array $tags = [];

    public string $title = '';
    public ?string $description = '';
    public ?string $goal = '';
    public ?string $competence = '';
    public ?DateTime $start_date = null;
    public ?DateTime $end_date = null;
    public ?int $quota = null;
    public bool $is_paid = false;
    public string $price = '';
    public ?string $link_lms = '';
    public bool $is_published = false;
    public ?int $category_id = null;


    public ?UploadedFile $file = null;
    public array $selectedTags = [];
    public array $selectedContactPersons = [];
    public ?string $model_id = null;

    private CourseService $courseService;
    private CourseRequest $courseRequest;

    protected $listeners = [
        'edit',
        'delete',
        'showImage',
        'togglePublish'
    ];

    public function boot(CourseService $courseService)
    {
        $this->courseService = $courseService;
        $this->courseRequest = new CourseRequest();
    }

    public function mount()
    {
        $this->authorize('courses');
        $this->initializeData();
    }

    private function initializeData(): void
    {
        $this->meta_title = CourseService::isDPP() ? 'All Courses' : 'My Courses';
        $this->categories = (new CategoryService)->getCategories();
        $this->tags = (new TagService)->getTags();
        // $this->wa_cs = Auth::user()->phone;
    }

    public function render()
    {
        return view('livewire.master.courses')
            ->layoutData([
                'title' => $this->meta_title,
                'isSidebarOpen' => 'true',
                'isHeaderBlur' => 'true'
            ]);
    }

    public function store()
    {
        $validatedData = $this->validateAndFormatData();

        try {
            $courseDTO = CourseDTO::fromObject($validatedData);
            $this->courseService->storeCourse($courseDTO, $this->file);

            $this->handleSuccess();

        } catch (Exception $e) {

            $this->handleError($e);
            $this->logError('Course', 'creation', [
                'error' => $e->getMessage(),
                'data' => $validatedData ?? null
            ]);
        }
    }

    private function validateAndFormatData(): array
    {
        $isFile = (!$this->model_id || $this->file) ? true : false;

        return $this->validate($this->courseRequest->rules($isFile));
    }

    private function handleSuccess(): void
    {
        $this->resetFields();
        $this->notifySuccess();
        $this->dispatch('refreshDatatable');
    }

    private function handleError(Exception $e): void
    {
        $this->notifyError($e->getMessage());
    }

    private function resetFields(bool $closeModal = true): void
    {
        foreach ($this->courseRequest::DEFAULT_VALUES as $property => $value) {
            if (property_exists($this, $property)) {
                $this->{$property} = $value;
            }
        }

        if ($this->file) {
            $this->file = null;
        }

        $this->wa_cs = Auth::user()->phone;

        if ($closeModal) {
            $this->dispatch('close-modal');
        }
    }

    private function resetSpecificFields(string|array $fields): void
    {
        $fieldsToReset = is_array($fields) ? $fields : [$fields];

        foreach ($fieldsToReset as $field) {
            if (array_key_exists($field, $this->courseRequest::DEFAULT_VALUES)) {
                $this->{$field} = $this->courseRequest::DEFAULT_VALUES[$field];
                // $this->resetValidation($field);
            }
        }
    }

    public function edit(string $id): void
    {
        try {
            $course = $this->courseService->findOrFail($id);
            $this->fillFormData($course);
            $this->openEditModal();
        } catch (Exception $e) {
            $this->handleEditError($e);
        }
    }

    private function fillFormData(Course $course): void
    {
        $this->model_id = $course->id;
        $this->title = $course->title;
        $this->category_id = $course->category_id;
        $this->price = currency($course->price, true);
        $this->wa_cs = $course->wa_cs;
        $this->link_lms = $course->link_lms;
        $this->description = $course->description;
        $this->selectedTags = $course->tags->pluck('id')->toArray(); // Tambahkan ini

        // Set preview image jika ada
        if ($course->hasMedia(Course::IMAGE_COLLECTION)) {
            $this->showImageUrl = $course->getFirstMediaUrl(Course::IMAGE_COLLECTION);
        }
    }

    private function openEditModal(): void
    {
        $this->resetValidation();
        $this->dispatch('open-modal', [
            'title' => 'Edit Course',
            'mode' => 'edit'
        ]);
    }

    private function handleEditError(Exception $e): void
    {
        $this->logError('Course', 'edit', [
            'error' => $e->getMessage(),
            'model_id' => $this->model_id ?? null
        ]);

        $this->notifyError(__('Failed to load course data'));
    }

    public function delete($id)
    {
        $this->model_id = $id;

        $this->dispatch('open-modal', modalKey: 'confirm');
    }

    public function destroy()
    {
        try {
            $this->courseService->deleteCourse($this->model_id);
            $this->handleSuccess();

        } catch (Exception $e) {
            $this->handleError($e);
            $this->logError('Course', 'deletion', [
                'error' => $e->getMessage(),
                'model_id' => $this->model_id
            ]);
        }
    }

    public function showImage($src)
    {
        $this->showImageUrl = $src;

        $this->dispatch('open-modal', modalKey: 'show-image');
    }

    public function togglePublish(string $id): void
    {
        try {
            $this->courseService->togglePublishStatus($id);
            $this->notifySuccess('Status berhasil diperbarui');
            $this->dispatch('refreshDatatable');

        } catch (Exception $e) {
            $this->logError('Course', 'toggle publish status', [
                'error' => $e->getMessage(),
                'model_id' => $id
            ]);
            $this->notifyError('Gagal mengubah status');
        }
    }
}
