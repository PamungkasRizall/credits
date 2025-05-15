<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

trait Loggable
{
    protected function logError(string $message, string $action, array $context = []): void
    {
        Log::error("{$message} {$action} failed", [
            'error' => $context['error'] ?? null,
            'data' => $context['data'] ?? null,
            'user_id' => Auth::id()
        ]);
    }

    protected function logInfo(string $message, string $action, array $context = []): void
    {
        Log::info("{$message} {$action} success", [
            'data' => $context['data'] ?? null,
            'user_id' => Auth::id()
        ]);
    }
}
