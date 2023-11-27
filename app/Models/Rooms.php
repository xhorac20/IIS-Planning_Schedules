<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;

class Rooms extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'location',
        'capacity'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'capacity' => 'integer',
        'created_at' => 'datetime',
    ];

    private mixed $name;
    private mixed $location;
    private mixed $capacity;
    /**
     * @var \Illuminate\Support\Carbon|mixed
     */
    private mixed $created_at;

    public static function create(array $data): static
    {
        // Vytvoříme novou instanci User
        $room = new static();

        // Nastavíme atributy

        $room->name = $data['name'];
        $room->location = $data['location'];
        $room->capacity = $data['capacity'];
        $room->created_at = now();

        // Uložíme uživatele do databáze
//        $room->save();
//        dd($room);
        DB::table('rooms')->insert($data);

        // Vrátíme nově vytvořeného uživatele
        return $room;
    }
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
    // Metoda pro definici vztahu k rozvrhu
    public function schedules(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Schedules::class, 'room_id');
    }
}
