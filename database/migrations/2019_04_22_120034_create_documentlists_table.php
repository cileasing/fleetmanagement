<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentlists', function (Blueprint $table) {
            $table->increments('documentlists_id');
            $table->string('docID');
            $table->string('document_type');
            $table->integer('totalCost');
            $table->date('maxDate');
            $table->date('next_expiry_year');
            $table->string('dcount');
            $table->string('createdBy');
            $table->string('status')->default('0');
             $table->string('approvedBy');
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
        Schema::dropIfExists('documentlists');
    }
}
