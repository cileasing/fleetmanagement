<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->increments('contracts_id');
           $table->string('contract_title');
           $table->string('contract_description');
           $table->date('commencement_date');
           $table->string('contract_type');
           $table->string('contract_number');
           $table->string('contract_location');
           $table->string('budgeted_income');
           $table->string('budgeted_expenditure');
           $table->string('term_of_operations');
           $table->string('targeted_invoice_date');
           $table->string('targeted_payment_date');
           $table->string('vat_applicable');
           $table->string('withholding_tax');
           $table->string('contact_person_name');
           $table->string('contact_person_email_address');
           $table->string('contact_person_phone_number');
           $table->string('contract_manager');
           $table->string('duration');
           $table->string('membership');
            $table->string('contract_status')->default('1');;
            $table->string('cid')->default('0');
            $table->string('del')->default('0');;
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
        Schema::dropIfExists('contracts');
    }
}
