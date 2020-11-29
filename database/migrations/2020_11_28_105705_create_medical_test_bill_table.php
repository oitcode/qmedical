<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalTestBillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_test_bill', function (Blueprint $table) {
            $table->bigIncrements('medical_test_bill_id');

            /*
             * Foreign key to medical_test table.
             */
            $table->unsignedBigInteger('medical_test_id');
            $table->foreign('medical_test_id', 'fk_medical_test_bill_medical_test')
                ->references('medical_test_id')->on('medical_test');

            $table->integer('amount');
            $table->string('payment_status');
            $table->string('comment', 255)->nullable();

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
        Schema::dropIfExists('medical_test_bill');
    }
}
