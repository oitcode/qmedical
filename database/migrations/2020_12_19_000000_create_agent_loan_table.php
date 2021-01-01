<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentLoanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_loan', function (Blueprint $table) {
            $table->bigIncrements('agent_loan_id');

            /*
             * Foreign key to agent table.
             */
            $table->unsignedBigInteger('agent_id');
            $table->foreign('agent_id', 'fk_agent_loan_agent')
                ->references('agent_id')->on('agent');

            $table->date('date');
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
        Schema::dropIfExists('agent_loan');
    }
}
