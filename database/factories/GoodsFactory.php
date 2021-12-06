<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class GoodsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama_barang' => $this->faker->colorName,
            'stok_barang' => $this->faker->numerify('###'),
            'harga_barang' => $this->faker->numerify('##000')
        ];
    }
}
