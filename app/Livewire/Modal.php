<?php

namespace App\Livewire;

use Livewire\Component;

class Modal extends Component
{
    public $showModal = false;
    public $confirmModal = false;

    protected $listeners = [
        'showModal',
        'showModalUpload',
        'confirmModal',
        'edit',
        'delete',
        'show'
    ];

    public function showModal()
    {
        $this->showModal = true;
        $this->resetFields();
    }

    public function confirmModal()
    {
        $this->confirmModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->confirmModal = false;
        $this->resetFields();
    }
}
