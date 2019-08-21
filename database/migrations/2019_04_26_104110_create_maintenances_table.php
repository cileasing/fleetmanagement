<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMaintenancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenances', function (Blueprint $table) {
            $table->increments('maint_id');
            $table->string('branch_office');
            $table->integer('vehicle_id');
            $table->string('driver');
            $table->string('fault_type');
            $table->string('complaint');
            $table->string('client');
            $table->string('maint_type');
            $table->string('mileage_km');
            $table->date('mileage_date');
            $table->string('mileage_time');
            $table->string('location');
            $table->string('workshop');
            $table->string('priority');
            $table->string('maint_request_file');
            $table->date('request_date');
            $table->string('maint_status');
            $table->string('insurance');
            $table->string('job_order_comments');
            $table->string('job_order_approval_date');
            $table->string('estimated_cost');
            $table->string('workshop_in');
            $table->string('workshop_out');
            $table->string('approved_cost');
            $table->string('maint_rating');
            $table->string('maint_comment');
            $table->string('maint_icu_approval');
            $table->string('maint_icu_comment');
            $table->date('maint_payment_date');
            $table->string('maint_payment_remark');
            $table->string('del');
            $table->string('cid');
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
        Schema::dropIfExists('maintenances');
    }
}
