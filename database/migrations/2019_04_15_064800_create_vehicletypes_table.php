<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVehicletypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicletypes', function (Blueprint $table) {
            $table->increments('vehicle_type_id');
            $table->string('vehicle_type_name');
            $table->string('vehicle_type_description');
            $table->string('vehicle_type_status')->default('1');
            $table->string('cid')->default('0');
            $table->string('del')->default('0');
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
        Schema::dropIfExists('vehicletypes');
    }
}
