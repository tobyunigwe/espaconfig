<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
//            $table->unsignedBigInteger('action_id')->nullable();
            $table->string('priority')->nullable();
            $table->string('requiredReceipt')->nullable();
            $table->string('retryCount')->nullable();
            $table->string('subject')->nullable();
//            $table->foreign('action_id')->references('id')->on('actions')->onDelete('SET NULL');
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
        Schema::dropIfExists('messages');
    }
}
