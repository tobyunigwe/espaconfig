<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateModifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('modifies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('message_id')->nullable();
            $table->string('type')->nullable();
            $table->string('text')->nullable();
            $table->foreign('message_id')->references('id')->on('messages')->onDelete('SET NULL');
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
        Schema::dropIfExists('modifies');
    }
}
