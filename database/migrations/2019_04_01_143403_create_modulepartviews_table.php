<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulepartviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modulepartviews', function (Blueprint $table) {
            $table->increments('module_part_id');
            $table->string('module_part_name');
            $table->string('module_part_description');
            $table->string('module_part_cid');
            $table->string('module_part_url');
            $table->string('module_part_status');
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
        Schema::dropIfExists('modulepartviews');
    }
}
