<?php
namespace Database\Seeders;

// use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**  
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $this->call([
            UsersTableSeeder::class,
            ProvinceSeeder::class,
            CitySeeder::class,
            DistrictSeeder::class,
            DistributorSeeder::class,
            DriverSeeder::class,
            VehicleSeeder::class,
            GoodsSeeder::class,
            ProductionSeeder::class,
            ProductionDetailSeeder::class,
            SalesTransactionSeeder::class,
            SalesTransactionDetailSeeder::class,
            PaymentSeeder::class,
            DeliverySeeder::class,
            DeliveryDetailSeeder::class,
            ProductReturnSeeder::class,
            ProductReturnDetailSeeder::class,
        ]);
    }
}
