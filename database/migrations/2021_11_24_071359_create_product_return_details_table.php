<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductReturnDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_return_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_return_id');
            $table->foreign('product_return_id')->references('id')->on('product_returns');
            $table->foreignId('sales_transaction_detail_id');
            $table->foreign('sales_transaction_detail_id')->references('id')->on('sales_transaction_details');
            $table->integer('qty_return');
            $table->string('alasan_return');
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
        Schema::dropIfExists('product_return_details');
    }
}
