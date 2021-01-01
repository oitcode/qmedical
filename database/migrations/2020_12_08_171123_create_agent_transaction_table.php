<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_transaction', function (Blueprint $table) {
            $table->bigIncrements('agent_transaction_id');

            /*
             * Foreign key to agent table.
             */
            $table->unsignedBigInteger('agent_id');
            $table->foreign('agent_id', 'fk_agent_transaction_agent')
                ->references('agent_id')->on('agent');

            /*
             * Foreign key to medical_test table.
             */
            $table->unsignedBigInteger('medical_test_id')->nullable();
            $table->foreign('medical_test_id', 'fk_agent_transaction_medical_test')
                ->references('medical_test_id')->on('medical_test');

            $table->date('date');
            $table->integer('amount');
            $table->string('direction');

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
        Schema::dropIfExists('agent_transaction');
    }
}
