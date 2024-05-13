<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        // 'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function acquisitions()
    {
        return $this->hasMany(DocumentAcquisition::class);
    }

    // public function complaintsReceived()
    // {
    //     return $this->hasMany(Complaint::class, 'student_user_id');
    // }

    public function complaintsSubmitted()
    {
        return $this->hasMany(Complaint::class, 'faculty_user_id');
    }

    public function facultyInfo()
    {
        return $this->hasOne(Faculty::class);
    }

    public function feedback()
    {
        return $this->hasMany(UserFeedback::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'student_user_id');
    }

    public function reportsSubmitted()
    {
        return $this->hasMany(Complaint::class, 'faculty_user_id');
    }

    public function studentInfo()
    {
        return $this->hasOne(Student::class);
    }

}
