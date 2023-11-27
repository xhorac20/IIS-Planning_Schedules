<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class Subject extends Model
{
    use HasFactory;

    public mixed $code;
    public mixed $name;
    public mixed $annotation;
    public mixed $credits;
    public mixed $guarantor_id;

    protected $fillable = [
        'code',
        'name',
        'annotation',
        'credits',
        'guarantor_id'
    ];

    protected $casts = [
        'guarantor_id' => 'integer'
    ];

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

}
