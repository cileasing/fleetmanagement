<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulecolumnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulecolumns', function (Blueprint $table) {
            $table->increments('column_id');
            $table->integer('module_id');
            $table->string('db');
            $table->integer('dt');
            $table->text('column_description');
            $table->integer('column_status');
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
        Schema::dropIfExists('modulecolumns');
    }
}
