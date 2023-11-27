<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property string $role
 * @property Collection|Subject[] $subjects
 * @property Collection|Schedules[] $schedules
 */
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
        'role'
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
    private mixed $email;
    private mixed $name;
    private mixed $password;
    private mixed $role;

    public static function create(array $data): static
    {
        // Vytvoříme novou instanci User
        $user = new static();

        // Nastavíme atributy

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);

        if(!isset($data['role'])) {
            $data['role'] = 'user';
        }
        $user->role = $data['role'];

//        dd($user);
        // Uložíme uživatele do databáze
//        $user->save();
        DB::table('users')->insert($data);

        // Vrátíme nově vytvořeného uživatele
        return $user;
    }

    public function getUserRole() {
        if (!isset($this->role)) {
            $role = DB::table('users')
                ->where('id', $this->id)
                ->first();

            $this->role = $role ? $role->role : 'guest';
        }
        return $this->role;
    }


    /**
     * Checks if the user is an administrator/guarantor/teacher/scheduler/student.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        $role = $this->getUserRole();
        return 'admin' === $role;
    }

    public function isGuarantor(): bool
    {
        $role = $this->getUserRole();
        return 'guarantor' === $role;
    }

    public function isTeacher(): bool
    {
        $role = $this->getUserRole();
        return 'teacher' === $role;
    }

    public function isScheduler(): bool
    {
        $role = $this->getUserRole();
        return 'scheduler' === $role;
    }

    public function isStudent(): bool
    {
        $role = $this->getUserRole();
        return 'student' === $role;
    }

    //Definuje vztahy, které umožňují uživateli být garantem předmětu a vyučujícím v rozvrhu.
    public static function findOrFail($id): \Illuminate\Database\Eloquent\Builder|Model
    {
        $user = self::find($id);
        if (!$user) {
            throw new ModelNotFoundException();
        }
        return $user;
    }

    public static function find($id): \Illuminate\Database\Eloquent\Builder|Model
    {
        return self::where('id', $id)->first();
    }

    public static function where(string $column, $operator = null, $value = null): \Illuminate\Database\Eloquent\Builder
    {
        return self::query()->where($column, $operator, $value);
    }

    public function subjects(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Subject::class, 'guarantor_id');
    }

    public function schedules(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Schedules::class, 'instructor_id');
    }

    public function scheduleRequirements(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(ScheduleRequirement::class, 'instructor_id');
    }

    // Jakékoli další metody...
}
