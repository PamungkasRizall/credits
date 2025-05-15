<?php

namespace App\Services;

use App\Models\Tag;

class TagService
{
    public function getTags(): array
    {
        return Tag::pluck('name', 'id')
            ->sort()
            ->toArray();
    }
}
