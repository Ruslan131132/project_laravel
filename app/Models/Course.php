<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'img',
        'price',
        'training_period',
        'teacher_id',
    ];

    public function pupil()
    {
        return $this->belongsToMany(Pupil::class, 'pupils_courses');
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
