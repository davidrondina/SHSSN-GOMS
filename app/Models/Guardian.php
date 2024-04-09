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
        'phone_no',
        'email',
    ];

    public function getFullName()
    {
        return $this->surname .
            (($this->suffix) ? (' ' . $this->suffix . ', ') : ', ') .
            $this->first_name .
            (($this->middle_name) ? (' ' . substr($this->middle_name, 0, 1) . '.') : '')
        ;
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
