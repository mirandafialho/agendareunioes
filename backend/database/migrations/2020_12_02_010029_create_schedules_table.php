<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->dateTime('beginning_date');
            $table->dateTime('conclusion_date');
            $table->time('duration');
            $table->text('description');
            $table->foreignId('guest_client_id')->nullable();
            $table->foreignId('guest_collaborator_id')->nullable();
            $table->foreignId('requester_client_id')->nullable();
            $table->foreignId('requester_collaborator_id')->nullable();
            $table->tinyInteger('accept')->comment('0 - Não. 1 - Sim.')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('guest_client_id')->references('id')->on('clients');
            $table->foreign('guest_collaborator_id')->references('id')->on('collaborators');
            $table->foreign('requester_client_id')->references('id')->on('clients');
            $table->foreign('requester_collaborator_id')->references('id')->on('collaborators');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
