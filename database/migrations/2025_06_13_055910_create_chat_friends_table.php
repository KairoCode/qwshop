<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chat_friends', function (Blueprint $table) {
            $table->id();
            $table->string('sid',32)->default('0')->comment('发送者ID');
            $table->string('rid',32)->default('0')->comment('接收者ID');
            $table->string('stype',20)->default('Anonymous')->comment('发送者类型'); // #Anonymous 匿名 #User 用户表 #Admin 管理员表
            $table->string('rtype',20)->default('Anonymous')->comment('接收者类型'); // #Anonymous 匿名 #User 用户表 #Admin 管理员表
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_friends');
    }
};
