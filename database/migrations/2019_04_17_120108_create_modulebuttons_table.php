<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulebuttonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulebuttons', function (Blueprint $table) {
            $table->increments('button_id');
            $table->string('button_name');
            $table->string('button_url');
            $table->string('button_icon');
            $table->string('button_module_link');
            $table->string('contract_status')->default('1');
            $table->string('cid')->default('0');
            $table->string('del')->default('0');;
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
        Schema::dropIfExists('modulebuttons');
    }
}
