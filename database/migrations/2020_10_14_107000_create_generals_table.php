<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('generals', function (Blueprint $table) {
            $table->id();
//            $table->unsignedBigInteger('config_id')->nullable();
//            $table->unsignedBigInteger('espa_id')->nullable();
//            $table->unsignedBigInteger('sdr_id')->nullable();
            $table->boolean('dryMode')->nullable();
            $table->integer('logLevel')->nullable();
//            $table->foreign('config_id')->references('id')->on('configs')->onDelete('SET NULL');
//            $table->foreign('espa_id')->references('id')->on('espas')->onDelete('SET NULL');
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
        Schema::dropIfExists('generals');
    }
}
