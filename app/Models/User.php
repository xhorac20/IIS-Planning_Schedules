<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'name',
        'email',
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
        'password' => 'hashed',
    ];

    /**
     * Checks if the user is an administrator/guarantor/teacher/scheduler/student.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return 'admin' === $this->role;
    }

    public function isGuarantor(): bool
    {
        return 'guarantor' === $this->role;
    }

    public function isTeacher(): bool
    {
        return 'teacher' === $this->role;
    }

    public function isScheduler(): bool
    {
        return 'scheduler' === $this->role;
    }

    public function isStudent(): bool
    {
        return 'student' === $this->role;
    }

    //Definuje vztahy, které umožňují uživateli být garantem předmětu a vyučujícím v rozvrhu.
    public function subjects(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Subject::class, 'guarantor_id');
    }

    public function schedules(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Schedules::class, 'instructor_id');
    }
    // Jakékoli další metody...
}
