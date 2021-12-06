<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Delivery;
use App\Models\SalesTransactionDetail;

class DeliveryDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $delivery_ids = Delivery::select('id')->get();
        $sales_transaction_detail_ids = SalesTransactionDetail::select('id')->get();

        return [
            'delivery_id' =>$this->faker->randomElement($delivery_ids),
            'sales_transaction_detail_id' => $this->faker->randomElement($sales_transaction_detail_ids),
            'qty_barang_dikirim' => $this->faker->numerify('###'),
        ];
    }
}
