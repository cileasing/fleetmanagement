<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
             
        Schema::create('trips', function (Blueprint $table) {
           $table->increments('trip_id');
            $table->string('passenger names');
            $table->string('number of passengers');
            $table->string('passenger_phone_numbers');
            $table->string('departure');
            $table->string('destination');
            $table->string('end_date_time');
            $table->string('pick_up_date_time');
            $table->string('number_of _days');
            $table->string('price_per_day');
            $table->enum('service_type', ['pickup', 'drop_off', 'daily_rental']);
            $table->string('additional_information');
            $table->string('driver');
            $table->string('vehicle_id');
            $table->string('cid')->default('0');
            $table->string('del')->default('0');
            $table->string('logged_by');
            $table->string('created_by');
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
        Schema::dropIfExists('trips');
    }
}
