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

    public function getfullYear()
    {
        return $this->start . ' - ' . $this->end;
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
