<?php

namespace App\Models;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * @property int $id
 * @property int $user_id
 * @property int $schedule_id
 * @property Schedules $schedule
 * @property User $student
 */
class StudentSchedule extends Model
{
    use HasFactory;

    // Určuje, ktoré stĺpce môžu byť hromadne priradené
    protected $fillable = ['user_id', 'schedule_id'];

    // Vráti rozvrhovú aktivitu priradenú k záznamu študentského rozvrhu
    public function schedule(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Schedules::class);
    }

    // Vráti študenta, ktorému patrí tento záznam rozvrhu
    public function student(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    /**
     * Skontroluje, či je daný predmet pridaný do rozvrhu aktuálneho študenta.
     *
     * @param int $subjectId ID predmetu
     * @return bool True, ak je predmet pridaný do rozvrhu, inak false.
     */
    public static function isAddedToStudentSchedule(int $subjectId): bool
    {
        $userId = Auth::id(); // Získa ID aktuálne prihláseného užívateľa

        // Najprv získame ID rozvrhov, ktoré sú spojené s daným predmetom
        $scheduleIds = Schedules::join('educational_activities', 'schedules.educational_activity_id', '=', 'educational_activities.id')
            ->where('educational_activities.subject_id', $subjectId)
            ->pluck('schedules.id');

        // Potom overíme, či existuje záznam v 'student_schedules', ktorý obsahuje toto schedule ID a ID študenta
        return StudentSchedule::where('user_id', $userId)
            ->whereIn('schedule_id', $scheduleIds)
            ->exists();
    }

}
