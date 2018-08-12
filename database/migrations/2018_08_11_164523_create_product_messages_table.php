<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_conversation_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->text('message');
            $table->integer('is_read')->default(0);
            $table->timestamps();

            $table->foreign('product_conversation_id')->references('id')
            ->on('product_conversations')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_messages');
    }
}
