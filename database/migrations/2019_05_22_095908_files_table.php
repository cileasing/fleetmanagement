<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('files', function (Blueprint $table) {

            $table->increments('id');
            $table->string('table_name');
            $table->string('table_pk');
            $table->string('request_id');
            $table->string('org_filenames');
             $table->string('filenames');
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
         Schema::dropIfExists('files');
    }
}
