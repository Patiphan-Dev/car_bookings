<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',     // ชื่อรถ
        'license_plate', // ทะเบียนรถ
        'brand',    // ยี่ห้อรถ
        'model',    // รุ่นรถ
        'seat_count', // จำนวนที่นั่ง
        'vin',      // เลขตัวถัง
        'warranty_expiration_date', // วันหมดอายุประกัน
        'tax_act_expiration_date',  // วันหมดอายุภาษี/พรบ.
        'status',   // สถานะรถ
        'images',
        'note',     // หมายเหตุ
    ];

    protected $casts = [
        'images' => 'array'
    ];

    /**
     * ความสัมพันธ์กับการจองรถ (Booking)
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
