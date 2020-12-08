<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentSettlementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent_settlement', function (Blueprint $table) {
            $table->bigIncrements('agent_settlement_id');

            /*
             * Foreign key to agent table.
             */
            $table->unsignedBigInteger('agent_id');
            $table->foreign('agent_id', 'fk_agent_settlement_agent')
                ->references('agent_id')->on('agent');

            /*
             * Foreign key to medical_test.
             */
            $table->unsignedBigInteger('medical_test_id');
            $table->foreign('medical_test_id', 'fk_agent_settlement_medical_test')
                ->references('medical_test_id')->on('medical_test');

            $table->date('date');

            $table->timestamps();
            $table->string('comment', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('agent_settlement');
    }
}
