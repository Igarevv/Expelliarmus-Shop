<?php

namespace Modules\User\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\User\Database\Factories\UserFactory;
use Ramsey\Uuid\Uuid;

/**
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $user_id
 * @property Carbon $email_verified_at
 * @property string $password
 * @property int $id
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    protected $hidden = [
        'id',
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes'
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (User $user) {
            if ($user->user_id === null) {
                $user->user_id = Uuid::uuid7()->toString();
            }
        });
    }

    protected static function newFactory(): UserFactory
    {
        return new UserFactory();
    }
}