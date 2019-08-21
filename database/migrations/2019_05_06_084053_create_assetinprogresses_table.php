<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetinprogressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assetinprogresses', function (Blueprint $table) {
            $table->increments('aipid');
            $table->string('aip_type');
            $table->string('asset_id');
            $table->string('asset_type');
           $table->string('description');
           $table->string('unit_approval');
            $table->string('approval');
            $table->string('cost');
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
        Schema::dropIfExists('assetinprogresses');
    }
}
