<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmailMission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_missions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('template_id')->nullable(false)->comment("模版ID");
            $table->string('subject')->nullable(false)->comment("主题");
            $table->string('from_email')->nullable(false)->comment("发件人账号");
            $table->string('from_name')->nullable(false)->comment("发件人");
            $table->timestamp('send_at')->nullable(false)->comment("发送时间");
            $table->timestamps();
            $table->index("template_id", "template_index");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_missions');
    }
}
