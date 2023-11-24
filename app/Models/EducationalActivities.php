<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'subject_id', // předpokládá, že existuje vztah s předmětem (Subject)
        // Další atributy podle potřeby
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
