<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    public function mark()
    {
        return $this->hasMany(Mark::class);
    }
    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }
}
