<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['teacher_ids'];

    protected $casts = [
        'teacher_ids' => 'array',
    ];

    /**
     * Pridá ID učiteľa do zoznamu teacher_ids.
     *
     * @param int $teacherId
     */
    public function addTeacher(int $teacherId): void
    {
        $teacherIds = $this->teacher_ids ?? [];

        if (!in_array($teacherId, $teacherIds)) {
            $teacherIds[] = $teacherId;
            $this->teacher_ids = $teacherIds;
            $this->save();
        }
    }

    /**
     * Odstráni ID učiteľa zo zoznamu teacher_ids.
     *
     * @param int $teacherId
     */
    public function removeTeacher($teacherId): void
    {
        $teacherIds = $this->teacher_ids ?? [];

        if (($key = array_search($teacherId, $teacherIds)) !== false) {
            unset($teacherIds[$key]);
            $this->teacher_ids = $teacherIds;
            $this->save();
        }
    }

    public function guarantor(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'guarantor_id');
    }

    public function educationalActivities(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(EducationalActivities::class);
    }

    public function teachers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(User::class, 'id', 'teacher_ids');
    }


}
