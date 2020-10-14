<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRetryschemasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('retryschemas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('conference_id')->nullable();
            $table->integer('interval')->nullable();
            $table->integer('count')->nullable();
            $table->foreign('conference_id')->references('id')->on('conferences')->onDelete('SET NULL');
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
        Schema::dropIfExists('retryschemas');
    }
}
