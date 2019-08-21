<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumenttypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documenttypes', function (Blueprint $table) {
            $table->increments('document_types_id');
            $table->string('document_types_name');
            $table->string('document_types_frequency');
            $table->string('document_types_organisation');
            $table->string('document_types_cost');
            $table->string('document_types_renewable');
            $table->string('document_types_mandatory');
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
        Schema::dropIfExists('documenttypes');
    }
}
