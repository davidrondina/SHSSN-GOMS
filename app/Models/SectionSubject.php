<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionSubject extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_id',
        'faculty_subject_id',
    ];

    public function sections()
    {
        return $this->belongsToMany(Section::class);
    }

    public function facultySubject()
    {
        return $this->belongsTo(FacultySubject::class);
    }
}
