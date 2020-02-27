<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            //コメントID (comment_id)/SERIAL
            $table->increments('comment_id')->unsigned();
            //イベントID (event_id)/INTEGER
            $table->integer('event_id')->unsigned();
            //コメント(comment)/TEXT
             $table->text('comment');
            //コメント編集
            $table->string('comment_edit')->default(false);
            //登録日時
            $table->timestamps();

            //外部キー
             $table->engine = 'InnoDB';
             $table->foreign('event_id')
                    ->references('event_id')
                     ->on('events')
                     ->onDelete('cascade');
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
