<?php

namespace Database\Factories;

use App\Models\Province;
use Illuminate\Database\Eloquent\Factories\Factory;

class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $province_ids = Province::select('id')->get();

        return [
            'nama_kab_kota' => $this->faker->city,
            'province_id' =>$this->faker->randomElement($province_ids),
        ];
    }
}
