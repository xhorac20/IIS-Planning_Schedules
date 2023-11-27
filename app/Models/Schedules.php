<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
