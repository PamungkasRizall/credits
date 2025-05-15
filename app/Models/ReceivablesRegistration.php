<?php

namespace App\Models;

use App\Enums\ReceivablesRegistrationStatus;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Ramsey\Uuid\Uuid;

class ReceivablesRegistration extends Authenticatable
{
    use HasApiTokens, HasFactory, HasRoles, Notifiable, SoftDeletes;

    public const CONTRACT_NO = 'FSBH/KEC/NUMBER/YEAR/MONTH';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $guarded = ['id'];

    protected $casts = [
        'date_at' => 'date',
        'updated_at' => 'datetime',
        'created_at' => 'datetime',
        'deleted_at' => 'datetime',
        'status' => ReceivablesRegistrationStatus::class,
    ];

	protected static function booted(): void
    {
        static::creating(function ($model) {
            do{

                $uuid = Uuid::uuid4();

                $uuid_exist = self::where('id', $uuid)->exists();

            } while ($uuid_exist);

            do{

                $year = Carbon::make($model->date_at)->format('Y');
                $number = self::where('year', $year)->max('number') + 1;
                $reg_code = 'REG.PIU.' . sprintf('%03d', $number) .'/' . $year;

                $reg_code_exist = self::where('reg_code', $reg_code)->exists();

            } while ($reg_code_exist);

            $model->id = $uuid;
            $model->reg_code = $reg_code;
            $model->number = $number;
            $model->year = $year;
            $model->created_by = Auth::id();
        });

        static::updating(function ($model) {

            $model->updated_by = Auth::id();
        });

        static::deleting(function ($model) {
            $model->deleted_by = Auth::id();
        });
    }

    public function installments(): HasMany
    {
        return $this->hasMany(Installment::class);
    }

    public function consumer(): BelongsTo
    {
        return $this->belongsTo(Consumer::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function sales(): BelongsTo
    {
        return $this->belongsTo(User::class)->select('id', 'name');
    }

    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(User::class)->select('id', 'name');
    }

    public function wasdit(): BelongsTo
    {
        return $this->belongsTo(User::class)->select('id', 'name');
    }

    public function ar(): BelongsTo
    {
        return $this->belongsTo(User::class)->select('id', 'name');
    }

    public function collector(): BelongsTo
    {
        return $this->belongsTo(User::class)->select('id', 'name');
    }
}
