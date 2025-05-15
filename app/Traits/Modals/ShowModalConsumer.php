<?php

namespace App\Traits\Modals;

use App\Models\Consumer;

trait ShowModalConsumer
{
    public ?String $consumerDesc = null;
    public ?Consumer $consumer = null;
    public ?string $consumer_id;

    public function showModalConsumer(): void
    {
        $this->dispatch('open-modal', modalKey: 'consumer');
    }

    public function selectedConsumer($row): void
    {
        $this->consumer = $this->consumerService->findOrFail($row['id']);
        $this->consumerDesc = $this->consumer->name;
        $this->consumer_id = $this->consumer->id;

        if (method_exists($this,'updatedConsumer'))
        {
            $this->updatedConsumer();
        }

        $this->dispatch('close-modal');
    }
}

