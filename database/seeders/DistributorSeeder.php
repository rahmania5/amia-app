<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Distributor;

class DistributorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory(40)->create();

        foreach($users as $user){
            Distributor::factory(1)->create(['user_id' => $user->id]);
        }
    }
}
