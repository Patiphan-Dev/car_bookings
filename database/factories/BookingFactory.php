<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Booking;
use App\Models\User;
use App\Models\Car;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'car_id' => Car::factory(),
            'usage_type' => $this->faker->randomElement(['งานราชการ', 'งานส่วนตัว', 'อื่นๆ']),
            'purpose' => $this->faker->sentence,
            'subject' => $this->faker->sentence,
            'location' => $this->faker->city,
            'ผู้จอง' => $this->faker->name,
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'count_days' => $this->faker->numberBetween(1, 7),
            'start_time' => $this->faker->dateTime,
            'end_time' => $this->faker->dateTime,
            'count_hours' => $this->faker->numberBetween(1, 24),
            'count_people' => $this->faker->numberBetween(1, 10),
            'note' => $this->faker->sentence,
            'status' => 'pending',
        ];
    }
}
