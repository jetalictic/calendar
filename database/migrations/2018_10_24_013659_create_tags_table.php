<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned();
            $table->foreign('event_id')
                  ->references('id')->on('events')
                  ->onDelete('cascade');
            $table->integer('sender_user_id')->unsigned();
            $table->foreign('sender_user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->integer('receiver_user_id')->unsigned();
            $table->foreign('receiver_user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('tags');
    }
}
