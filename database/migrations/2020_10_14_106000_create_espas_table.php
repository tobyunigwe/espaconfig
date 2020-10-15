<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEspasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('espas', function (Blueprint $table) {
            $table->bigIncrements("id");
            $table->unsignedBigInteger('config_id')->nullable();
            $table->integer('enabled')->nullable();
            $table->timestamps();
            $table->foreign('config_id')->references('id')->on('configs')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('espas');
    }
}
