<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Teacher extends Model
{
    protected $fillable = [
        'id',
        'name',
        'surname',
        'patronymic'
    ];


    /**
     * @var mixed
     */

    use HasFactory;



    public function schedule(){
        return $this->belongsToMany(
            Schedule::class,
            'schedules_teachers',
            'teacher_id',
            'schedule_id'
        );
    }


    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }

    public function class()
    {
        return $this->hasOne(ClassInfo::class, 'teacher_id', 'id');
    }
    public function course()
    {
        return $this->hasMany(Course::class);
    }
}
