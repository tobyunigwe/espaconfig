<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipientEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipient_emails', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recipient_id')->nullable();
            $table->string('email')->nullable();
            $table->foreign('recipient_id')->references('id')->on('recipients')->onDelete('SET NULL');
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
        Schema::dropIfExists('recipient_emails');
    }
}
