<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vessel_assets', function (Blueprint $table) {
            $table->increments('asset_id');
            $table->string('vessel_Name')->unique();;
            $table->string('vessel_Ex_Name');
            $table->string('contract_type')->nullable();
            $table->double('price', 8, 2)->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('vessel_Type');
            $table->string('Owner_vessel_manager');
            $table->string('IMO_Number')->nullable();
            $table->string('Call_Sign')->nullable();
            $table->string('Client')->nullable();
            $table->string('Flag')->nullable();
            $table->string('Class')->nullable();
            $table->string('Deadweight')->nullable();
            $table->string('Displacement')->nullable();
            $table->string('Gross_Tonnage')->nullable();
            $table->string('TEU_Capacity')->nullable();
            $table->string('Length')->nullable();
            $table->string('Beam')->nullable();
            $table->string('Draft')->nullable();
            $table->string('Age_of_vessel')->nullable();
            $table->string('Engine_power')->nullable();
            $table->string('Fleet_manager')->nullable();;
            $table->string('Built')->nullable();;
            $table->string('Size')->nullable();;
            $table->string('Draught')->nullable();;
            $table->string('Builder')->nullable();;
            $table->string('Place_of_build')->nullable();;
            $table->string('Net_Tonnage')->nullable();;
            $table->string('Crude')->nullable();;
            $table->enum('status', ['active', 'inactive', 'disposed', 'under-maintenance','faulty']);
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
        Schema::dropIfExists('assets');
    }
}
