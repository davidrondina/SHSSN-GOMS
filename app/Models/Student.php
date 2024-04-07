<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'guardian_id',
        'lrn',
    ];

    public function enrolments()
    {
        return $this->hasMany(EnrolledStudent::class);
    }

    public function getFullName()
    {
        return $this->surname .
            (($this->suffix) ? (' ' . $this->suffix . ', ') : ', ') .
            $this->first_name .
            (($this->middle_name) ? (' ' . substr($this->middle_name, 0, 1) . '.') : '')
        ;
    }

    public function guardian()
    {
        return $this->belongsTo(Guardian::class);
    }

    public function isEnrolledToCurrentAY()
    {
        $year = AcademicYear::where('is_current', true)->first();

        return EnrolledStudent::where('academic_year_id', $year->id)->exists();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class, 'section_students');
    }
}
