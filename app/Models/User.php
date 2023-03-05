<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone',
        'password',
        'role',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function professors()
    {
        return self::where('role', 'professor')->get();
    }

    public static function students()
    {
        return self::where('role', 'student')->get();
    }

    public function subjects(): HasMany|BelongsToMany|null
    {
        if ($this->isStudent()) {
            return $this->belongsToMany(Subject::class);
        } elseif ($this->isProfessor()) {
            return $this->hasMany(Subject::class);
        }
        return null;

    }

    public function isStudent(): bool
    {
        return $this->role == 'student';
    }

    public function isProfessor(): bool
    {
        return $this->role == 'professor';
    }

    public function lectures(): ?BelongsToMany
    {
        if ($this->role == 'student') return $this->belongsToMany(Lecture::class);
        return null;
    }

    public function isAdmin(): bool
    {
        return $this->role == 'admin';
    }
}
