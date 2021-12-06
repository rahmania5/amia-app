<?php

namespace Database\Factories;

use App\Models\Production;
use App\Models\Goods;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductionDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $production_ids = Production::select('id')->get();
        $goods_ids = Goods::select('id')->get();

        return [
            'production_id' => $this->faker->randomElement($production_ids),
            'goods_id' =>$this->faker->randomElement($goods_ids),
            'qty_barang_jadi' => $this->faker->numerify('###'),
            'qty_barang_rusak' => $this->faker->numerify('1#')
        ];
    }
}
