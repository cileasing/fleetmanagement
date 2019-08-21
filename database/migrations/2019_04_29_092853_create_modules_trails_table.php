<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTrailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules_trails', function (Blueprint $table) {
            $table->increments('id');
            $table->string('workdone');
            $table->string('item_id');
            $table->string('module_id');
            $table->string('workdate');
            $table->string('worked_by');
            $table->string('cid');
            $table->string('del')->default('0');
            $table->timestamps();
            $table->softDeletes();
            $table->string('logged_by');
            $table->string('created_by');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('modules_trails');
    }
}
