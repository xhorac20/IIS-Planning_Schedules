<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $type
 * @property int $duration
 * @property string $repetition
 * @property string|null $event_date
 * @property int|null $room_id
 * @property int|null $teacher_id
 * @property array|null $preferred_day_time
 */
class EducationalActivities extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'duration',
        'type',
        'repetition',
        'subject_id',
        'event_date',
        'room_id',
        'teacher_id',
        'preferred_day_time',
        // Dalsie atributy podla potreby
    ];

    protected $casts = [
        'preferred_day_time' => 'array',
    ];


    /**
     * Získá předmět, ke kterému aktivita patří.
     */
    public function subject(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    // Další vztahy, například s vyučujícím nebo místností
    public function teacher(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function room(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Rooms::class);
    }

    // Další metody nebo logika specifická pro tento model
}
