<?php

namespace Database\Factories;

use App\Models\Car;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarFactory extends Factory
{
    protected $model = Car::class;

    public function definition()
    {
        return [
            'name' => $this->faker->company . ' Car',
            'license_plate' => strtoupper($this->faker->bothify('??-####')),
            'brand' => $this->faker->company,
            'model' => $this->faker->word,
            'seat_count' => $this->faker->numberBetween(2, 7),
            'vin' => strtoupper($this->faker->bothify('1HGCM82633A######')),
            'warranty_expiration_date' => $this->faker->date,
            'tax_act_expiration_date' => $this->faker->date,
            'status' => $this->faker->randomElement(['available', 'in_use', 'maintenance']),
            'note' => $this->faker->sentence,
        ];
    }
}

