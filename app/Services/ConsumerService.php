<?php

namespace App\Services;

use App\DTOs\ConsumerDTO;
use App\Models\Consumer;
use App\Models\Traits\HasMediaSetting;
use Illuminate\Support\Facades\DB;

class ConsumerService
{
    use HasMediaSetting;

    public function findOrFail(String $id): Consumer
    {
        return Consumer::with('lastTransaction')->findOrFail($id);
    }

    public function storeConsumer(ConsumerDTO $dto): Consumer
    {
        return DB::transaction(function () use ($dto) {
            $consumer = Consumer::updateOrCreate(
                ['id' => $dto->model_id],
                (array) $dto
            );

            $this->handleCompanion($consumer, $dto->companion);

            return $consumer;
        });
    }

    private function handleCompanion(Consumer $consumer, array $companion): void
    {
        $consumer->companion()->updateOrCreate(['consumer_id' => $consumer->id], $companion);
    }
}
