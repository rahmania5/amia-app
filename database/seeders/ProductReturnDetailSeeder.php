<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductReturnDetail;

class ProductReturnDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductReturnDetail::factory(40)->create();
    }
}
