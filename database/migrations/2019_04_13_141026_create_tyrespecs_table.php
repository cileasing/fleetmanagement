<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTyrespecsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tyrespecs', function (Blueprint $table) {
            $table->increments('tyre_specs_id');
            $table->string('tyre_specs_name');
            $table->string('tyre_specs_description');
            $table->string('tyre_status');
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
        Schema::dropIfExists('tyrespecs');
    }
}
