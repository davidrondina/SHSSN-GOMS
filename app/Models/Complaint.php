<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    protected $fillable = [
        'faculty_user_id',
        'student_id',
        'reason',
        'additional_info',
        'is_closed',
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
        return $this->belongsTo(Student::class, 'student_id');
    }
}
