<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetinprogresstypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assetinprogresstypes', function (Blueprint $table) {
            $table->increments('assetinprogresstypes_id');
            $table->string('aip_name');
            $table->string('aip_description');
            $table->string('aip_status')->default('1');
            $table->string('del')->default('0');
            $table->string('cid')->default('0');
            $table->string('logged_by');
            $table->string('created_by');
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
        Schema::dropIfExists('assetinprogresstypes');
    }
}
