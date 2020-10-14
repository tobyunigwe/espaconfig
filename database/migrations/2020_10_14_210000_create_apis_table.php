<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apis', function (Blueprint $table) {
            $table->id();
//            $table->unsignedBigInteger('config_id')->nullable();
            $table->string('primaryUrl')->nullable();
            $table->string('secondaryUrl')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('incomingSmsNumber')->nullable();
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
        Schema::dropIfExists('apis');
    }
}
