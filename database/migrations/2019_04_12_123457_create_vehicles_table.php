<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->increments('vehicle_id');
            $table->string('vehicle_number');
            $table->string('vehicle_make');
            $table->string('plate_number');
            $table->string('vehicle_model');
            $table->string('start_mileage');
            $table->string('service_type');
            $table->string('vehicle_group');
            $table->string('chasis_number');
            $table->string('engine_number');
            $table->string('vehicle_driver');
            $table->string('vehicle_co_driver');
            $table->string('assigned_to');
            $table->string('cid');
            $table->string('capacity');
            $table->string('color');
            $table->string('office');
            $table->string('location');
            $table->string('transmission_type');
            $table->string('battery_spec');
            $table->string('tyre_spec');
            $table->string('purchase_date');
            $table->string('purchase_amount');
            $table->string('supplier');
            $table->string('year');
            $table->string('vehicle_status');
            $table->string('del');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicles');
    }
}
