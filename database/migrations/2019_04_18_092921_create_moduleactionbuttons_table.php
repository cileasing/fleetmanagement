<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModuleactionbuttonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moduleactionbuttons', function (Blueprint $table) {
            $table->increments('action_button_id');
             $table->string('action_name');
            $table->string('button_icon');
            $table->string('action_route');
            $table->string('button_module_id');
            $table->string('action_button_status')->default('1');
            $table->string('cid')->default('0');
            $table->string('del')->default('0');;
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
        Schema::dropIfExists('moduleactionbuttons');
    }
}
