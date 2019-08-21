<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetutilizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assetutilizations', function (Blueprint $table) {
            $table->increments('asset_id');
            $table->string('asset_utilization_id');
            $table->string('asset_name');
            $table->string('asset_type');
            $table->string('utilization_type');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('utilization_status')->default('1');
            $table->string('cid')->default('0');
            $table->string('del')->default('0');
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
        Schema::dropIfExists('assetutilizations');
    }
}
