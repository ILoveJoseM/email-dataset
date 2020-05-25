<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmailQueues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_queues', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mission_id')->nullable(false)->comment("任务ID");
            $table->string('to_email')->nullable(false)->comment("发件人账号");
            $table->tinyInteger('status')->nullable(false)->comment("状态 0-待发送 1-已发送 2-失败");
            $table->string('err_msg')->nullable(false)->default("")->comment("失败原因");
            $table->timestamps();
            $table->index(["mission_id"], "mission_index");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_queues');
    }
}
