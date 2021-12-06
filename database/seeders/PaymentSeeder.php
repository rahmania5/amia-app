<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\SalesTransaction;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sales_transaction_lunas= SalesTransaction::where('jenis_pembayaran', 'Lunas')->get();
        $sales_transaction_utang= SalesTransaction::where('jenis_pembayaran', 'Utang')->get();

        foreach($sales_transaction_lunas as $lunas){
            Payment::factory(1)->create(['sales_transaction_id' => $lunas->id]);
        }

        foreach($sales_transaction_utang as $utang){
            Payment::factory(2)->create(['sales_transaction_id' => $utang->id]);
        }
    }
}
