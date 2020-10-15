<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActionReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_references', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('timeframe_id')->nullable();
            $table->string('ActionReference')->nullable();
            $table->foreign('timeframe_id')->references('id')->on('timeframes')->onDelete('SET NULL');
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
        Schema::dropIfExists('action_references');
    }
}
