<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Installment extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable;

    protected $guarded = ['id'];

    protected $casts = [
        'date_at' => 'date',
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
    ];

	protected static function booted(): void
    {
        static::creating(function ($model) {
            $model->created_by = Auth::id();
        });

        static::updating(function ($model) {

            $model->updated_by = Auth::id();
        });
    }

    public function receivablesRegistration(): BelongsTo
    {
        return $this->belongsTo(ReceivablesRegistration::class);
    }
}
