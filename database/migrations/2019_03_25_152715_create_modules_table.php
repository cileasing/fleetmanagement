<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateModulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modules', function (Blueprint $table) {
            $table->increments('modules_id');
            $table->string('module_title');
            $table->string('module_description');
            $table->string('module_url');
            $table->string('cid');
            $table->string('module_primary_key');
            $table->string('module_table');
            $table->string('module_db_table');
            $table->string('module_alert_account');
            $table->integer('module_value');
             $table->string('module_category');
            $table->integer('module_status');
            $table->text('module_add_items');
            $table->string('modules_unique_item');
            $table->string('module_display_items');
             $table->string('module_search_items');
            $table->string('module_order_by');
            $table->string('module_group_by');
            $table->string('module_set_owner');
            $table->string('module_owner_item');
            $table->string('module_header_sum');
            $table->string('module_header_item');
            $table->string('module_add_button');
            $table->string('module_edit_button');
            $table->string('module_add_user');
            $table->string('module_edit_user');
            $table->string('all_items');
            $table->string('del');
            $table->softDeletes();
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
        Schema::dropIfExists('modules');
    }
}
