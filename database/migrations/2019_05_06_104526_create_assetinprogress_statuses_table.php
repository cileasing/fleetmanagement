<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetinprogressStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assetinprogress_statuses', function (Blueprint $table) {
            $table->increments('api_status_id');
            $table->string('name');
            $table->string('status')->default('1');
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
        Schema::dropIfExists('assetinprogress_statuses');
    }
}
