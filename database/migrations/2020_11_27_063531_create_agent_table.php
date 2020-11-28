<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agent', function (Blueprint $table) {
            $table->bigIncrements('agent_id');
            $table->string('name', 255);
            $table->string('sex', 1)->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email', 255)->nullable()->unique();
            $table->string('address', 255)->nullable();
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
        Schema::dropIfExists('agent');
    }
}
