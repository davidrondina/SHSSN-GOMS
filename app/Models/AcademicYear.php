<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;

    protected $fillable = [
        'start',
        'end',
        'is_current',
    ];

    public function enrolledStudents()
    {
        return $this->hasMany(EnrolledStudent::class);
    }

    public function getfullYear()
    {
        return $this->start . ' - ' . $this->end;
    }

    public function goodMoralForms()
    {
        return $this->hasMany(GoodMoralForm::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
