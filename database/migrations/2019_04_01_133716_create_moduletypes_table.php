<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuletypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moduletypes', function (Blueprint $table) {
            $table->increments('module_type_id');
            $table->string('module_type_name');
            $table->string('module_type_description');
            $table->string('module_type_cid');
            $table->string('module_type_status');
             $table->string('icon');
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
        Schema::dropIfExists('moduletypes');
    }
}
