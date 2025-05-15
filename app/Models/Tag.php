<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    public function taggables()
    {
        return $this->morphedByMany(Course::class, 'taggable');
    }
}
