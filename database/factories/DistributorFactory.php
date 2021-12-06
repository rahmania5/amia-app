<?php

namespace Database\Factories;

use App\Models\District;
use Illuminate\Database\Eloquent\Factories\Factory;

class DistributorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $district_ids = District::select('id')->get();

        return [
            'nik' => $this->faker->numerify('################'),
            'user_id' => 1,
            'district_id' =>$this->faker->randomElement($district_ids),
            'alamat' => $this->faker->address,
            'no_telepon' => $this->faker->numerify('08##########')
        ];
    }
}
