<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient', function (Blueprint $table) {
            /* Make these nullable */
            $table->string('sex', 1)->nullable()->change();
            $table->date('dob')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient', function (Blueprint $table) {
            /* Make these non nullable */
            $table->string('sex', 1)->nullable(false)->change();
            $table->date('dob')->nullable(false)->change();
        });
    }
}
