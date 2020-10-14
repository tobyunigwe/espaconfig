<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conferences', function (Blueprint $table) {
            $table->id();
//            $table->unsignedBigInteger('action_id')->nullable();
            $table->boolean('record')->nullable();
            $table->Integer('voiceMessageId')->nullable();
            $table->string('language')->nullable();
            $table->integer('ringTimeout')->nullable();
            $table->boolean('recording')->nullable();
            $table->boolean('announceNames')->nullable();
            $table->string('title')->nullable();
            $table->boolean('detectVoiceMail')->nullable();
            $table->Integer('callerId')->nullable();
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
        Schema::dropIfExists('conferences');
    }
}
