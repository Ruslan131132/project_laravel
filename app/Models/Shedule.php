<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shedule extends Model
{
    use HasFactory;
    public function class()
    {
        return $this->belongsTo(ClassInfo::class);
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
