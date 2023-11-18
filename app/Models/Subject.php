<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    public function guarantor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'guarantor_id');
    }

    public function educationalActivities(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EducationalActivities::class);
    }

}
