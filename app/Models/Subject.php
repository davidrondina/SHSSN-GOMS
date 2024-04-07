<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function faculties()
    {
        return $this->belongsToMany(Faculty::class, 'faculty_subjects');
    }

    public function sections()
    {
        return $this->hasMany(SectionSubject::class);
    }
}
