<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $capacity
 * @property Collection|Schedules[] $schedules
 */
class Rooms extends Model
{
    use HasFactory;

    // Metoda pro definici vztahu k rozvrhu
    public function schedules(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Schedules::class, 'room_id');
    }
}
