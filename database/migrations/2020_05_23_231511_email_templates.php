<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EmailTemplates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('email_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable(false)->comment("模版名字");
            $table->string('view')->nullable(false)->comment("模版文件路径");
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
        Schema::dropIfExists('email_templates');
    }
}
