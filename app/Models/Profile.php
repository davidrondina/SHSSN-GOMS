<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'surname',
        'suffix',
        'sex',
        'address',
        'phone_no',
    ];

    public function getFullName()
    {
        return $this->surname .
            (($this->suffix) ? (' ' . $this->suffix . ', ') : ', ') .
            $this->first_name .
            (($this->middle_name) ? (' ' . substr($this->middle_name, 0, 1) . '.') : '')
        ;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
