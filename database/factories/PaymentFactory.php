<?php

namespace Database\Factories;

use App\Models\SalesTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sales_transaction_ids = SalesTransaction::select('id')->get();
        
        return [
            'sales_transaction_id' => $this->faker->randomElement($sales_transaction_ids),
            'metode_pembayaran' => $this->faker->randomElement($array = array ('Cash','Transfer')),
            'tanggal_pembayaran' => $this->faker->dateTimeThisYear()->format('Y-m-d'),
            'jumlah_pembayaran' => $this->faker->numerify('#######')
        ];
    }
}
