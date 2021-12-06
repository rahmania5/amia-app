<?php

namespace Database\Factories;

use App\Models\Distributor;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $distributor_ids = Distributor::select('id')->get();
        
        return [
            'distributor_id' => $this->faker->randomElement($distributor_ids),
            'tanggal_transaksi' => $this->faker->dateTimeThisYear()->format('Y-m-d'),
            'jenis_pembayaran' => $this->faker->randomElement($array = array ('Lunas','Utang')),
            'total_transaksi' => $this->faker->numerify('#######'),
            'tanggal_kirim' => $this->faker->dateTimeThisYear()->format('Y-m-d'),
            'status' => "Selesai"
        ];
    }
}
