<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pupil extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }

    public function class()
    {
        return $this->belongsTo(ClassInfo::class);
    }

    public function course()
    {
        return $this->belongsToMany(Course::class, 'pupils_courses');
    }

    public function mark()
    {
        return $this->hasMany(Mark::class);
    }
}
