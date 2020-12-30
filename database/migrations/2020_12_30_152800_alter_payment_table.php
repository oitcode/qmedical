<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('payment', function (Blueprint $table) {
            /* make reference to medical_test nullable */
            $table->unsignedBigInteger('medical_test_id')->nullable()->change();

            /*
             * Foreign key to agent_loan table.
             */
            $table->unsignedBigInteger('agent_loan_id')->nullable();
            $table->foreign('agent_loan_id', 'fk_payment_agent_loan')
                ->references('agent_loan_id')->on('agent_loan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('payment', function (Blueprint $table) {
            /* make reference to medical_test not nullable */
            $table->unsignedBigInteger('medical_test_id')->nullable(false)->change();

            /*
             * Remove Foreign key to agent_loan table.
             */
            $table->dropForeign('fk_payment_agent_loan');
            $table->dropColumn('agent_loan_id');
        });
    }
}
