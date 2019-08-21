<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract_type', function (Blueprint $table) {
            $table->increments('contract_type_id');
            $table->string('contract_type_name');
            $table->string('asset_type');
            $table->string('cid');
            $table->string('del');
            $table->string('type_status');
             $table->string('type_description');
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
        Schema::dropIfExists('con_contract_setup');
    }
}
