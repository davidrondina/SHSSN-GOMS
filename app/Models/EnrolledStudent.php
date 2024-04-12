<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrolledStudent extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'academic_year_id',
        'strand_id',
        'grade_level',
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function strand()
    {
        return $this->belongsTo(Strand::class);
    }
}
