<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
           //イベントID (event_id)/INTEGER
            $table->increments('id')->unsigned();
            //しおりID (schedule_id)/SERIAL
            $table->integer('schedule_id')->unsigned();
            //イベント名 (event_title)/VARCHAR(50)
            $table->string('event_title',50);
            //イベント日付(event_date)/DATE
            $table->date('event_date');
            //イベント開始時間(event_start)/TIME
            $table->time('event_start');
            //イベント終了時間('event_end')/TIME
            $table->time('event_end');
            //イベント名編集
            $table->string('edit_title')->default(false);
            //イベント開始時間編集
            $table->string('edit_start')->default(false);
            //イベント終了編集
            $table->string('edit_end')->default(false);
            //登録日時 (created_at)/TIMESTAMP
            $table->timestamps();


            //外部キー
            $table->engine = 'InnoDB';
             $table->foreign('schedule_id')
                    ->references('id')
                    ->on('schedules')
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
        Schema::dropIfExists('events');
    }
}
