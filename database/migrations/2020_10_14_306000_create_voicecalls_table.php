<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoicecallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voicecalls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('message_id')->nullable();
            $table->Integer('voiceMessageId')->nullable();
            $table->foreign('message_id')->references('id')->on('messages')->onDelete('SET NULL');
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
        Schema::dropIfExists('voicecalls');
    }
}
