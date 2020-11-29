<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentCommissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_commission', function (Blueprint $table) {
            $table->bigIncrements('agent_commission_id');

            /*
             * Foreign key to medical_test_bill table.
             */
            $table->unsignedBigInteger('medical_test_bill_id');
            $table->foreign('medical_test_bill_id', 'fk_agent_commission_medical_test_bill')
                ->references('medical_test_bill_id')->on('medical_test_bill');

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
        Schema::dropIfExists('agent_commission');
    }
}
