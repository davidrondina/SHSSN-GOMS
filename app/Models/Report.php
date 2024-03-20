<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'faculty_user_id',
        'student_user_id',
        'reason_id',
        'additional_info',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function complainant()
    {
        return $this->belongsTo(User::class, 'faculty_user_id');
    }

    public function reason()
    {
        return $this->belongsTo(Reason::class);
    }

    public function respondent()
    {
        return $this->belongsTo(User::class, 'student_user_id');
    }
}
