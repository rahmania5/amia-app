<?php

namespace Database\Factories;

use App\Models\Driver;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $driver_ids = Driver::select('id')->get();
        $vehicle_ids = Vehicle::select('id')->get();

        return [
            'driver_id' => $this->faker->randomElement($driver_ids),
            'vehicle_id' => $this->faker->randomElement($vehicle_ids),
            'tanggal_pengantaran' => $this->faker->dateTimeThisYear()->format('Y-m-d'),
            'jam_berangkat' => $this->faker->time($format = 'H:i:s'),
            'jam_diterima' => $this->faker->time($format = 'H:i:s')
        ];
    }
}
