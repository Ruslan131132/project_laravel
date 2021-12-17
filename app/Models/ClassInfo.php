<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassInfo extends Model
{
    use HasFactory;
    protected $table = 'classes';

    public function pupils()
    {
        return $this->hasMany(Pupil::class, 'id', 'pupil_id');
    }
    public function teacher()
    {
        return $this->hasOne(Teacher::class, 'id', 'teacher_id');
    }
    public function employment()
    {
        return $this->hasMany(Employment::class);
    }
    public function shedule()
    {
        return $this->hasMany(Shedule::class);
    }
}
