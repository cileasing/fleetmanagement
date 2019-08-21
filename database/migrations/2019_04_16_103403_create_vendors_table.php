<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->increments('vendor_id');
            $table->string('vendor_name');
            $table->string('vendor_contact_address');
            $table->string('vendor_email');
            $table->string('vendor_phone');
            $table->string('vendor_type');
            $table->string('vendor_bank_name');
            $table->string('vendor_account_number');
            $table->string('vendor_status')->default('1');
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
        Schema::dropIfExists('vendors');
    }
}
