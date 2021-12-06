<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_transaction_id');
            $table->foreign('sales_transaction_id')->references('id')->on('sales_transactions');
            $table->string('metode_pembayaran');
            $table->date('tanggal_pembayaran');
            $table->integer('jumlah_pembayaran');
            $table->string('keterangan')->nullable();
            $table->binary('bukti_pembayaran')->nullable();
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
        Schema::dropIfExists('payments');
    }
}
