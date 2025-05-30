<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TargetParticipant extends Model
{
    protected $guarded = ['id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
