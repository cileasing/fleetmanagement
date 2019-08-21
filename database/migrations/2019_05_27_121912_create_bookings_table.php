<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->increments('booking_id');
            $table->string('contact_name');
            $table->string('contact_email_address');
            $table->string('contact_phone_number');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('po_number');
            $table->enum('task_status', ['pending', 'submitted']);
            $table->string('task_document');
            $table->string('reservation_office');
            $table->string('reservation_officer');
            $table->enum('client_type', ['individual', 'company']);
            $table->enum('credit_type', ['credit', 'non_credit']);
            $table->string('reservation_date');
            $table->string('reservation_remark');
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
        Schema::dropIfExists('bookings');
    }
}
