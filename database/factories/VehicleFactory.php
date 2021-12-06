<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'no_polisi' => $this->faker->bothify('BA #### ???'),
            'jenis_kendaraan' => $this->faker->randomElement($array = array ('Daihatsu Hi Max','Daihatsu Grand Max', 'Mitsubishi L300'))
        ];
    }
}
