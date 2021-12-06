<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('distributor_id');
            $table->foreign('distributor_id')->references('id')->on('distributors');
            $table->date('tanggal_transaksi');
            $table->enum('jenis_pembayaran', ['Lunas','Utang']);
            $table->integer('total_transaksi')->default(0);
            $table->integer('sisa_utang')->default(0);
            $table->date('tanggal_kirim')->nullable();
            $table->string('status')->default('Belum dipesan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_transactions');
    }
}
