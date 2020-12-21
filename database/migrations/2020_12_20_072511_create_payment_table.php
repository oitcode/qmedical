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
            $table->unsignedBigInteger('medical_test_id');
            $table->foreign('medical_test_id', 'fk_payment_medical_test')
                ->references('medical_test_id')->on('medical_test');

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
