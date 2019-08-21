<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFueltypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fueltypes', function (Blueprint $table) {
            $table->increments('fuel_type_id');
            $table->string('fuel_name');
            $table->string('description');
            $table->string('logged_by');
            $table->string('created_by');
            $table->string('cid');
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
        Schema::dropIfExists('fueltypes');
    }
}
