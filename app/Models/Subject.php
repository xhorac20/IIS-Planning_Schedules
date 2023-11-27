<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

/**
 * @property int $id
 * @property string $code
 * @property string $name
 * @property string|null $annotation
 * @property int $credits
 * @property int $guarantor_id
 * @property array|null $teacher_ids
 * @property User $guarantor
 * @property Collection|EducationalActivities[] $educationalActivities
 * @property Collection|User[] $teachers
 */
class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'annotation',
        'credits',
        'guarantor_id',
        'teacher_ids'
    ];

    protected $casts = [
        'guarantor_id' => 'integer',
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
    public function removeTeacher(int $teacherId): void
    {
        $teacherIds = $this->teacher_ids ?? [];

        if (($key = array_search($teacherId, $teacherIds)) !== false) {
            unset($teacherIds[$key]);
            $this->teacher_ids = $teacherIds;
            $this->save();
        }
        // Odstránenie učiteľa z výukových aktivít
        $this->removeTeacherFromActivities($teacherId);
    }

    protected function removeTeacherFromActivities($teacherId): void
    {
        $this->educationalActivities()->where('teacher_id', $teacherId)->update(['teacher_id' => null]);
    }

    public static function create(array $data): static
    {
        // Vytvoříme novou instanci Subject
        $subject = new static();

        // Nastavíme atributy
        $subject->code = $data['code'];
        $subject->name = $data['name'];
        $subject->annotation = $data['annotation'];
        $subject->credits = $data['credits'];
        $subject->guarantor_id = $data['guarantor_id'];

//        $subject->save();
        DB::table('subjects')->insert($data);

        // Vrátíme nově vytvořeny predmet
        return $subject;
    }
    public static function findOrFail($id): \Illuminate\Database\Eloquent\Builder|Model
    {
        $subject = self::find($id);
        if (!$subject) {
            throw new ModelNotFoundException();
        }
        return $subject;
    }

    public static function find($id): \Illuminate\Database\Eloquent\Builder|Model
    {
        return self::where('id', $id)->first();
    }

    public static function where(string $column, $operator = null, $value = null): \Illuminate\Database\Eloquent\Builder
    {
        return self::query()->where($column, $operator, $value);
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
