<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment', function (Blueprint $table) {
            $table->bigIncrements('payment_id');

            /*
             * Foreign key to medical_test table.
             */
            $table->unsignedBigInteger('medical_test_id')->nullable();
            $table->foreign('medical_test_id', 'fk_payment_medical_test')
                ->references('medical_test_id')->on('medical_test');

            /*
             * Foreign key to agent_loan table.
             */
            $table->unsignedBigInteger('agent_loan_id')->nullable();
            $table->foreign('agent_loan_id', 'fk_payment_agent_loan')
                ->references('agent_loan_id')->on('agent_loan');

            /*
             * Foreign key to itself.
             *
             * One payment can trigger another payment if there is 
             * positive change in agent balance. If a payment was caused
             * by another payment, then store the reference to that causing
             * payment. In case the causing payment is cancelled/updated then this
             * payment need to be cancelled/updated too.
             *
             */
            $table->unsignedBigInteger('tg_payment_id')->nullable();
            $table->foreign('tg_payment_id', 'fk_payment_payment')
                ->references('payment_id')->on('payment');

            $table->integer('amount');
            $table->string('type');

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
        Schema::dropIfExists('payment');
    }
}
