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
        Schema::create('sms_logs', function (Blueprint $table) {
            $table->id();
            $table->string('phone', 15)->default('')->comment('手机号');
            $table->string('name', 15)->default('')->comment('类型');
            $table->string('content', 15)->default('')->comment('发送内容');
            $table->unsignedTinyInteger('status')->default(0)->comment('发送状态');
            $table->text('error_msg', 20)->comment('错误信息');
            $table->ipAddress('ip')->default('0.0.0.0')->comment('操作IP');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sms_logs');
    }
};
