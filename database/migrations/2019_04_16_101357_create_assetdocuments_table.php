<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssetdocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assetdocuments', function (Blueprint $table) {
            $table->increments('assetdocuments_id');
            $table->string('asset_office');
            $table->string('asset_name');
            $table->string('document_type');
            $table->string('issue_date');
            $table->string('expiry_date');
            $table->string('document_cost');
            $table->string('vendor');
            $table->string('document_types_status')->default('1');
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
        Schema::dropIfExists('assetdocuments');
    }
}
