<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartialPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partial_payment', function (Blueprint $table) {
            $table->bigIncrements('partial_payment_id');

            /*
             * Foreign key to medical_test table.
             */
            $table->unsignedBigInteger('medical_test_id');
            $table->foreign('medical_test_id', 'fk_partial_payment_medical_test')
                ->references('medical_test_id')->on('medical_test');

            $table->integer('amount');

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
        Schema::dropIfExists('partial_payment');
    }
}
