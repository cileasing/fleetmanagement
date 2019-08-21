<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHseincidencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hseincidences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('asset_type');
            $table->integer('asset_number');
            $table->integer('office');
            $table->integer('incident_type');
            $table->date('incident_date');
            $table->integer('incident_location');
            $table->text('incident_details');
            $table->string('incident_status')->default('1');
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
        Schema::dropIfExists('hseincidences');
    }
}
