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
        'first_name',
        'middle_name',
        'surname',
        'sex',
        'birthdate',
        'address',
        'phone_no',
    ];

    public function complaintsReceived()
    {
        return $this->hasMany(Complaint::class, 'student_id');
    }

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

    public function getCurrentGradeLvl()
    {
        $year = AcademicYear::where('is_current', true)->first();
        $currentEnrolment = EnrolledStudent::where([
            ['academic_year_id', $year->id],
            ['student_id', $this->id]
        ])->first();

        return $currentEnrolment->grade_level;
    }

    public function getCurrentSection()
    {
        $year = AcademicYear::where('is_current', true)->first();
        $student_id = $this->id;

        return SectionStudent::where('student_id', $this->id)->whereHas('section', function ($query) use ($year) {
            $query->where('academic_year_id', $year->id);
        })->first();
    }

    public function guardian()
    {
        return $this->belongsTo(Guardian::class);
    }

    public function isEnrolledToCurrentAY()
    {
        $year = AcademicYear::where('is_current', true)->first();

        return EnrolledStudent::where([
            ['academic_year_id', $year->id],
            ['student_id', $this->id]
        ])->exists();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sections()
    {
        return $this->belongsToMany(Section::class, 'section_students');
    }

    public function currentEnrolment()
    {
        $year = AcademicYear::where('is_current', true)->first();

        return EnrolledStudent::where([
            ['academic_year_id', $year->id],
            ['student_id', $this->id]
        ])->with(['strand'])->first();
    }
}
