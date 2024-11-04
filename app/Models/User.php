<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasRoles, HasFactory, Notifiable;

    /**
     * The "booted" method of the model.
     *
     * This method applies the global scope to automatically filter out inactive users.
     *
     * @return void
     */

    //  protected static function booted()
    //  {
    //      // Apply the active scope only during login or authentication-related actions
    //      if (!app()->runningInConsole() && request()->routeIs('login', 'auth.*')) {
    //          static::addGlobalScope('active', function (Builder $builder) {
    //              $builder->where('active', 1); // Only retrieve active users
    //          });
    //      }
    //  }

    protected static function booted()
    {
        // Apply the active scope only during login
        static::addGlobalScope('active', function (Builder $builder) {
            $builder->where('active', 1); // Only retrieve active users for login
        });

        // Set default role_id to 7 if not provided
        static::creating(function ($user) {
            if (is_null($user->role_id)) {
                $user->role_id = 7;
            }
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'dept_id',
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
}
