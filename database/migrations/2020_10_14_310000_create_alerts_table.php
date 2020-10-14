<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->id();
//            $table->unsignedBigInteger('action_id')->nullable();
            $table->integer('requiredPersons')->nullable();
            $table->integer('timeframe')->nullable();
            $table->integer('redundancy')->nullable();
            $table->string('strategy')->nullable();
            $table->string('contactProvider')->nullable();
            $table->string('finalState')->nullable();
            $table->integer('delayedTime')->nullable();
            $table->boolean('useOnlyPresent')->nullable();
            $table->boolean('cancelOnImpossible')->nullable();
            $table->boolean('stopOnImpossible')->nullable();
            $table->integer('retryCount')->nullable();
//            $table->foreign('action_id')->references('id')->on('actions')->onDelete('SET NULL');
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
        Schema::dropIfExists('alerts');
    }
}
