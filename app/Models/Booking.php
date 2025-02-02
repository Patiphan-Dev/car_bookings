<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'usage_type',
        'purpose',
        'subject',
        'location',
        'start_date',
        'end_date',
        'count_days',
        'start_time',
        'end_time',
        'count_hours',
        'count_minutes',
        'count_people',
        'note',
        'status',
    ];

    /**
     * ความสัมพันธ์กับ User (ผู้จอง)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * ความสัมพันธ์กับ Car (รถยนต์ที่ถูกจอง)
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    public function randomColor()
    {
        $colors = ['#00a65a', '#0073b7', '#f39c12', '#f56954', '#3c8dbc', '#d81b60', '#605ca8'];
        return $colors[array_rand($colors)];
    }
}
