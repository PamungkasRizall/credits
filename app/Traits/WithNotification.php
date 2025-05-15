<?php

namespace App\Traits;

trait WithNotification
{
    public function notify(string $type, string $message): void
    {
        $this->dispatch('notify', type: $type, message: $message);
    }

    public function notifySuccess(string $message = 'Successfully'): void
    {
        $this->notify('success', $message);
    }

    public function notifyError(string $message = 'An error occurred'): void
    {
        $this->notify('error', $message);
    }

    public function notifyWarning(string $message): void
    {
        $this->notify('warning', $message);
    }

    public function notifyInfo(string $message): void
    {
        $this->notify('info', $message);
    }
} 
