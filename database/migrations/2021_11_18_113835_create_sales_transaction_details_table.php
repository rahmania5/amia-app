<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTransactionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_transaction_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('goods_id');
            $table->foreign('goods_id')->references('id')->on('goods');
            $table->foreignId('sales_transaction_id');
            $table->foreign('sales_transaction_id')->references('id')->on('sales_transactions');
            $table->integer('qty');
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('sales_transaction_details');
    }
}
