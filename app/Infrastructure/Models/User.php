<?php

namespace App\Infrastructure\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Domains\Auth\Enums\Roles;
use App\Infrastructure\Models\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property string $phone
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function __construct()
    {
        parent::__construct();

        self::created(function (User $user) {
            $role = Roles::GUEST->value;

            if (!$user->roles()->get()->contains($role))
            {
                $user->roles()->attach($role);
            }
        });
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        $admin = Roles::ADMIN->value;

        return $this->roles()->get()->contains($admin);
    }

    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
}
