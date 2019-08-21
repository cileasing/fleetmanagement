<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehiclestatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehiclestatuses', function (Blueprint $table) {
            $table->increments('vstatus_id');
            $table->string('vstatus_name');
            $table->string('vstatus_description');
            $table->string('vstatus_status')->default('1');
            $table->string('del')->default('0');
            $table->string('cid')->default('0');
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
        Schema::dropIfExists('vehiclestatuses');
    }
}
