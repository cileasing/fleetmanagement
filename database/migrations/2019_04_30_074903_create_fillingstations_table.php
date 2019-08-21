<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFillingstationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fillingstations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('filling_station');
            $table->string('address');
            $table->string('phone');
            $table->string('contact_person');
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
        Schema::dropIfExists('fillingstations');
    }
}
