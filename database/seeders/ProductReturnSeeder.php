<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductReturn;

class ProductReturnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductReturn::factory(20)->create();
    }
}
