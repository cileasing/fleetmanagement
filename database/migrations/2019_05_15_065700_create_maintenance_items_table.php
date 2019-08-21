<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenanceItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_items', function (Blueprint $table) {
            $table->increments('maint_item_id');
            $table->string('maintenance_id');
            $table->string('type_name');
            $table->string('sub_type');
            $table->string('description');
            $table->string('quantity')->default('0');
            $table->string('estimated_cost');
            $table->string('approved_cost');
            $table->string('estimated_amount');
            $table->string('approved_amount');
            $table->string('item_status')->default('1');
            $table->string('cid')->default('0');
            $table->string('del')->default('0');
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
        Schema::dropIfExists('maintenance_items');
    }
}
