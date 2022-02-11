<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'class_id',
        'subject_id',
        'day_number',
        'lesson_number',
        'cabinet_id',
    ];

    public function teacher(){
        return $this->belongsToMany(
            Teacher::class,
            'schedules_teachers',
            'schedule_id',
            'teacher_id'
        );
    }

    public function class()
    {
        return $this->belongsTo(ClassInfo::class, 'class_id', 'id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function day()
    {
        return $this->belongsTo(Day::class, 'day_number', 'number');
    }
    public function lesson()
    {
        return $this->belongsTo(Lesson::class, 'lesson_number', 'number');
    }
    public function cabinet()
    {
        return $this->belongsTo(Cabinet::class);
    }
}
