<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_driver' => $this->faker->name($gender = 'male'),
            'nik' => $this->faker->numerify('################'),
        ];
    }
}
