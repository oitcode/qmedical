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
            $table->unsignedBigInteger('agent_id');
            $table->foreign('agent_id', 'fk_medical_test_agent')
                ->references('agent_id')->on('agent');

            $table->date('date');
            $table->string('doctor_name', 255)->nullable();
            $table->string('result', 255)->nullable();

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
        Schema::dropIfExists('medical_test');
    }
}
