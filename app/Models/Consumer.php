<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Ramsey\Uuid\Provider\Node\RandomNodeProvider;
use Ramsey\Uuid\Uuid;

class Consumer extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable, SoftDeletes;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = ['id'];

    protected $casts = [
        'date_of_birth' => 'date',
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

	protected static function booted(): void
    {
        static::creating(function ($model) {

            $nodeProvider = new RandomNodeProvider();
            do{

                $uuid = Uuid::uuid4();

                $uuid_exist = self::where('id', $uuid)->exists();

            } while ($uuid_exist);


            $model->id = $uuid;
        });
    }

    public function companion(): HasOne
    {
        return $this->hasOne(Companion::class, 'consumer_id');
    }

    public function subDistrict(): BelongsTo
    {
        return $this->belongsTo(SubDistrict::class, 'sub_district_code', 'sub_district_code');
    }

    public function lastTransaction(): HasOne
    {
        return $this->hasOne(ReceivablesRegistration::class)->latest('created_at');
    }
}
