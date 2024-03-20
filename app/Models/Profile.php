<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'middle_name',
        'surname',
        'suffix',
        'sex',
        'address',
        'phone_no',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
