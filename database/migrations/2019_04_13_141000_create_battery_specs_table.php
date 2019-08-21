<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBatterySpecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('battery_specs', function (Blueprint $table) {
            $table->increments('battery_specs_id');
             $table->string('battery_specs_name');
            $table->string('battery_specs_description');
            $table->string('battery_specs_status');
            $table->string('cid');
            $table->string('del');
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
        Schema::dropIfExists('battery_specs');
    }
}
