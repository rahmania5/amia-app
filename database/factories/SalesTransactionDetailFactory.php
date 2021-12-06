<?php

namespace Database\Factories;

use App\Models\Goods;
use App\Models\SalesTransaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesTransactionDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $goods_ids = Goods::select('id')->get();
        $sales_transaction_ids = SalesTransaction::select('id')->get();

        return [
            'goods_id' =>$this->faker->randomElement($goods_ids),
            'sales_transaction_id' => $this->faker->randomElement($sales_transaction_ids),
            'qty' => $this->faker->numerify('###')
        ];
    }
}
