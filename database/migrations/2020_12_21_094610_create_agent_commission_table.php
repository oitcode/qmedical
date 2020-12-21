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
             * Foreign key to medical_test table.
             */
            $table->unsignedBigInteger('medical_test_id')->nullable();
            $table->foreign('medical_test_id', 'fk_agent_commission_medical_test')
                ->references('medical_test_id')->on('medical_test');

            /*
             * Foreign key to agent table.
             */
            $table->unsignedBigInteger('agent_id');
            $table->foreign('agent_id', 'fk_agent_commission_agent')
                ->references('agent_id')->on('agent');

            $table->integer('amount');
            $table->string('direction');

            $table->string('comment', 255);
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
