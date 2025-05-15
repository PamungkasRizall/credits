<?php

namespace App\Models\Traits;

use Exception;
use Illuminate\Http\UploadedFile;

trait HasMediaSetting
{
    public function validateFile(UploadedFile $file, array $allowedExtensions): void
    {
        if (!in_array($file->getClientOriginalExtension(), self::ALLOWED_EXTENSIONS)) {
            throw new Exception('Format file tidak didukung. Format yang diizinkan: ' . implode(', ', self::ALLOWED_EXTENSIONS));
        }

        if ($file->getSize() > (self::MAX_FILE_SIZE * 1024)) {
            throw new Exception('Ukuran file terlalu besar. Maksimal ' . self::MAX_FILE_SIZE . 'KB');
        }
    }

    // private function generateFileName(string $title, UploadedFile $file): string
    // {
    //     $baseFileName = Str::slug($title);
    //     $extension = $file->getClientOriginalExtension();
    //     $timestamp = now()->timestamp;

    //     return "{$baseFileName}-{$timestamp}.{$extension}";
    // }

    // private function deleteExistingFile(Course $course): void
    // {
    //     if ($course->hasMedia(Course::IMAGE_COLLECTION)) {
    //         $course->clearMediaCollection(Course::IMAGE_COLLECTION);
    //     }
    // }
}
