<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $educational_activity_id
 * @property int $room_id
 * @property int $instructor_id
 * @property string $day
 * @property string $start_time
 * @property string $end_time
 * @property EducationalActivities $educationalActivity
 * @property Rooms $room
 * @property User $instructor
 */
class Schedules extends Model
{
    use HasFactory;

    // Určuje, ktoré stĺpce môžu byť hromadne priradené
    protected $fillable = [
        'educational_activity_id',
        'room_id',
        'instructor_id',
        'day',
        'start_time',
        'end_time'
        // Dalsie atributy podla potreby
    ];

    public function educationalActivity(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(EducationalActivities::class);
    }

    public function room(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Rooms::class, 'room_id');
    }

    public function instructor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

}
