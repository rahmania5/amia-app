<?php

namespace Database\Factories;

use App\Models\ProductReturn;
use App\Models\SalesTransactionDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductReturnDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $return_ids = ProductReturn::select('id')->get();
        $sales_transaction_detail_ids = SalesTransactionDetail::select('id')->get();

        return [
            'product_return_id' =>$this->faker->randomElement($return_ids),
            'sales_transaction_detail_id' => $this->faker->randomElement($sales_transaction_detail_ids),
            'qty_return' => $this->faker->numerify('##'),
            'alasan_return' => $this->faker->sentence($nbWords = 6)
        ];
    }
}
