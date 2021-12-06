<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductionDetail;

class ProductionDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductionDetail::factory(150)->create();
    }
}
