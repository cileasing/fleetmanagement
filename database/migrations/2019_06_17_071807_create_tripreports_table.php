<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripreportsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('tripreports', function (Blueprint $table) {
            $table->increments('trip_report_id');
            $table->string('asset_name');
            $table->date('trip_date');
            $table->time('trip_time');
            $table->string('event_name');
            $table->string('value');
            $table->string('address');
            $table->string('geofence_name');
            $table->string('fullname');
            $table->string('company');
            $table->string('year');
            $table->string('model');

            $table->string('distance_km');
            $table->string('speed_kmh');
            $table->string('date_time');
            $table->string('gps_time');
            $table->string('status');
            $table->string('engine_hours');
            $table->string('engine_hours_time');
            $table->string('unit_time_to_gps_time');
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
    public function down() {
        Schema::dropIfExists('tripreports');
    }

}
