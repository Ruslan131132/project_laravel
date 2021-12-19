<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;
    protected $fillable = ['mark', 'pupil_id', 'subject_id'];
    public function pupil()
    {
        return $this->belongsTo(Pupil::class);
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
