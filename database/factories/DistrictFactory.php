<?php

namespace Database\Factories;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\Factory;

class DistrictFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $city_ids = City::select('id')->get();

        return [
            'nama_kecamatan' => $this->faker->country,
            'city_id' =>$this->faker->randomElement($city_ids),
        ];
    }
}
