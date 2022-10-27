<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id'); // primaryキー
            $table->unsignedBigInteger('user_id'); // 外部キー
            $table->unsignedBigInteger('post_id'); // 外部キー
            $table->text('body');
            $table->timestamps();

            // 外部キー制約を付ける
            $table->foreign('user_id')->references('id')->on('users'); // commentsテーブルのuser_idは、userテーブルに保存されているidしか登録できない
            $table->foreign('post_id')->references('id')->on('posts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
