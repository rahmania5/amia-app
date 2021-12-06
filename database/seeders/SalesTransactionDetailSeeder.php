<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SalesTransactionDetail;

class SalesTransactionDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SalesTransactionDetail::factory(150)->create();
    }
}
