<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'department_id',
    ];

    public function advisorySection()
    {
        return $this->hasOne(Section::class, 'adviser_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'faculty_subjects');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
