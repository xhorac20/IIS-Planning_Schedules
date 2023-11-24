<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
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
        $user->role = $data['role'];

        // Uložíme uživatele do databáze
        $user->save();

        // Vrátíme nově vytvořeného uživatele
        return $user;
    }


    //Definuje vztahy, které umožňují uživateli být garantem předmětu a vyučujícím v rozvrhu.
    public static function findOrFail($id): \Illuminate\Database\Eloquent\Builder|Model
    {
        $user = self::find($id);

        if (!$user) {
            abort(404);
        }

        return $user;
    }

    public static function find($id): \Illuminate\Database\Eloquent\Builder|Model
    {
        return self::where('id', $id)->first();
    }

    private static function where(string $string, $id): \Illuminate\Database\Eloquent\Builder
    {
        return self::query()->where($string, $id);
    }

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
