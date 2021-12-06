<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id');
            $table->foreign('driver_id')->references('id')->on('drivers');
            $table->foreignId('vehicle_id');
            $table->foreign('vehicle_id')->references('id')->on('vehicles');
            $table->date('tanggal_pengantaran');
            $table->time('jam_berangkat');
            $table->time('jam_diterima')->nullable();
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
        Schema::dropIfExists('deliveries');
    }
}
