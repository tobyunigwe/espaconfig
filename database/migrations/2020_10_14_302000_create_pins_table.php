<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pins', function (Blueprint $table) {
            $table->id();
//            $table->unsignedBigInteger('sdr_id')->nullable();
            $table->integer('number')->nullable();
            $table->string('txt')->nullable();
            $table->string('normalState')->nullable();
            $table->string('email')->nullable();
            $table->integer('alertTimeout')->nullable();
//            $table->foreign('sdr_id')->references('id')->on('sdrs')->onDelete('SET NULL');
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
        Schema::dropIfExists('pins');
    }
}
