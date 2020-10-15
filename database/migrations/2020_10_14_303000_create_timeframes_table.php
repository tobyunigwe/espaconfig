<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeframesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timeframes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pin_id')->nullable();
            $table->unsignedBigInteger('rule_id')->nullable();
            $table->string('startTime')->nullable();
            $table->string('endTime')->nullable();
            $table->string('daysOfWeek')->nullable();
            $table->foreign('pin_id')->references('id')->on('pins')->onDelete('SET NULL');
            $table->foreign('rule_id')->references('id')->on('rules')->onDelete('SET NULL');
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
        Schema::dropIfExists('timeframes');
    }
}
