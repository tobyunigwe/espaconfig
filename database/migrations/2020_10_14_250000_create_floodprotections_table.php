<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFloodprotectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('floodprotections', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('general_id')->nullable();
            $table->integer('silentPeriod')->nullable();
            $table->boolean('silenceRequired')->nullable();
            $table->integer('expirePeriod')->nullable();
            $table->foreign('general_id')->references('id')->on('generals')->onDelete('SET NULL');
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
        Schema::dropIfExists('floodprotections');
    }
}
