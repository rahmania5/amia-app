<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductionDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('production_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('production_id');
            $table->foreign('production_id')->references('id')->on('productions');
            $table->foreignId('goods_id');
            $table->foreign('goods_id')->references('id')->on('goods');
            $table->integer('qty_barang_jadi');
            $table->integer('qty_barang_rusak')->default(0);
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
        Schema::dropIfExists('production_details');
    }
}
