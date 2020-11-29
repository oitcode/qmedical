<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalTestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medical_test', function (Blueprint $table) {
            $table->bigIncrements('medical_test_id');

            /*
             * Foreign key to patient table.
             */
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id', 'fk_medical_test_patient')
                ->references('patient_id')->on('patient');

            /*
             * Foreign key to agent table.
             */
            $table->unsignedBigInteger('agent_id')->nullable();
            $table->foreign('agent_id', 'fk_medical_test_agent')
                ->references('agent_id')->on('agent');

            /*
             * Foreign key to medical_test_type table.
             */
            $table->unsignedBigInteger('medical_test_type_id');
            $table->foreign('medical_test_type_id', 'fk_medical_test_medical_test_type')
                ->references('medical_test_type_id')->on('medical_test_type');

            $table->date('date');
            $table->string('status');
            $table->string('result', 255)->nullable();
            $table->string('result_remark', 255)->nullable();

            /* Billing */
            $table->integer('price');
            $table->string('payment_status');

            $table->integer('agent_commission')->nullable();
            $table->string('agent_commission_status')->nullable();

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
        Schema::dropIfExists('medical_test');
    }
}
