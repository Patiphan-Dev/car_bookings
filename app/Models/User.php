<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'position',
        'email',
        'phone',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    /**
     * ความสัมพันธ์กับการจองรถ (1 คนสามารถจองรถหลายครั้ง)
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }


    // /**
    //  * ตรวจสอบว่าเป็น Admin หรือไม่
    //  */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
