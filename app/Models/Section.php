<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'strand_id',
        'academic_year_id',
        'adviser_id',
        'name',
        'grade_level',
    ];

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function adviser()
    {
        return $this->belongsTo(Faculty::class, 'adviser_id');
    }

    public function subjects()
    {
        return $this->hasMany(SectionSubject::class);
        ;
    }

    public function strand()
    {
        return $this->belongsTo(Strand::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'section_students');
    }
}
