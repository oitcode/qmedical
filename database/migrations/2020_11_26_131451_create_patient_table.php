<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient', function (Blueprint $table) {
            $table->bigIncrements('patient_id');
            $table->string('name', 255);
            $table->string('sex', 1);
            $table->date('dob');
            $table->string('contact_number')->nullable();
            $table->string('email', 255)->nullable()->unique();
            $table->string('address', 255)->nullable();
            $table->string('passport_number')->nullable()->unique();
            $table->string('passport_expiry_date')->nullable();
            $table->string('passport_issue_place')->nullable();
            $table->string('nationality')->nullable();

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
        Schema::dropIfExists('patient');
    }
}
