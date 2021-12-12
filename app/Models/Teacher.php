<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }

    public function class()
    {
        return $this->hasOne(ClassInfo::class);
    }
    public function employment()
    {
        return $this->hasMany(Employment::class);
    }
    public function course()
    {
        return $this->hasMany(Course::class);
    }
}
