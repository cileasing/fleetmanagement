<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransmissiontypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transmissiontypes', function (Blueprint $table) {
            $table->increments('transmission_types_id');
            $table->string('transmission_types_name');
            $table->string('transmission_types_description');
            $table->string('transmission_types_status');
            $table->string('cid');
            $table->string('del')->default('0');
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
        Schema::dropIfExists('transmissiontypes');
    }
}
