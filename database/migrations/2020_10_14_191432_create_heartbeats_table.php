<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeartbeatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('heartbeats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('receiver_id')->nullable();
            $table->integer('timeout')->nullable();
            $table->string('statusFile')->nullable();
            $table->string('intervalFile')->nullable();
            $table->foreign('receiver_id')->references('id')->on('receivers')->onDelete('SET NULL');

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
        Schema::dropIfExists('heartbeats');
    }
}
