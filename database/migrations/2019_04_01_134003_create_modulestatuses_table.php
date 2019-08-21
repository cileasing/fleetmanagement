<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulestatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulestatuses', function (Blueprint $table) {
            $table->increments('module_status_id');
            $table->string('module_status_name');
            $table->string('module_status_description');
            $table->string('module_status_cid');
            $table->string('module_status_status');
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
        Schema::dropIfExists('modulestatuses');
    }
}
