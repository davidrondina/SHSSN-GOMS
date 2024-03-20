<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'surname',
        'suffix',
        'contact_no',
        'email',
    ];

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
