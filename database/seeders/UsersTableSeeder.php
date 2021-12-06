<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@amia.com',
            'password' => Hash::make('password'),
            'role' => 'Admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        $distributor = DB::table('users')->insert([
            'name' => 'Nadya',
            'email' => 'nadya@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'Distributor',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('distributors')->insert([
            'user_id' => $distributor->id,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        DB::table('users')->insert([
            'name' => 'Manager',
            'email' => 'manager@amia.com',
            'password' => Hash::make('password'),
            'role' => 'Manager',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
