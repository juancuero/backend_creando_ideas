<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DeviceFactory extends Factory
{
    public function definition()
    {
        return [
            'mac' => $this->faker->unique()->macAddress,
            'description' => $this->faker->sentence,
            'created_at' => $this->faker->dateTimeBetween('-2 month', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
