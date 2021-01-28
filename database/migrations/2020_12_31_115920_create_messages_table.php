<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->unsignedBigInteger('student');
            $table->foreign('student')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('instructor');
            $table->foreign('instructor')->references('id')->on('users')->onDelete('cascade');
            $table->integer('sent_by');
            $table->text('content');
            $table->integer('seen')->default(0);
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
