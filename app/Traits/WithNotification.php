<?php

namespace App\Traits;

use Exception;

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

    //global
    public function handleSuccess(string $dispatchName = 'all', ?string $redirectUrl = null): void
    {
        $this->notifySuccess();

        if ($dispatchName === 'all') {
            $this->dispatch('close-modal');
            $this->dispatch('refreshDatatable');
        } else if($dispatchName === 'redirect') {
            $this->dispatch('redirect', url: $redirectUrl);
        } else {
            $this->dispatch($dispatchName);
        }
    }

    public function handleError(Exception $e, string $action, ?string $secondaryMsg = null, array $context = []): void
    {
        $message = $secondaryMsg ?: $e->getMessage();
        $this->notifyError($message);

        $this->logError($e->getMessage(), $action, $context);
    }
}
