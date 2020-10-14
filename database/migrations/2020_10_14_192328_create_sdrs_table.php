<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSdrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sdrs', function (Blueprint $table) {
            $table->id();
//            $table->unsignedBigInteger('config_id')->nullable();
            $table->integer('enabled')->nullable();
//            $table->foreign('config_id')->references('id')->on('configs')->onDelete('SET NULL');
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
        Schema::dropIfExists('sdrs');
    }
}
