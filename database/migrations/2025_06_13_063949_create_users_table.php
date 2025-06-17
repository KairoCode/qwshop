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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('belong_id')->default(0)->comment('所属');
            $table->string('username', 15)->default('')->comment('用户名');
            $table->string('password', 60)->default('')->comment('密码');
            $table->string('pay_password', 60)->default('')->comment('支付密码');
            $table->string('nickname', 15)->default('')->comment('昵称');
            $table->unsignedTinyInteger('sex')->default(1)->comment('性别');
            $table->string('avatar', 150)->default('')->comment('头像');
            $table->string('phone', 15)->default('')->comment('电话');
            $table->string('email', 15)->default('')->comment('邮箱');
            $table->decimal('money', 9)->default(0.00)->comment('余额');
            $table->decimal('frozen_money', 9)->default(0.00)->comment('冻结资金');
            $table->decimal('integral', 9)->default(0.00)->comment('积分');
            $table->unsignedInteger('inviter_id')->default(0)->comment('邀请人ID');
            $table->unsignedTinyInteger('status')->default(1)->comment('账号状态');
            $table->timestamp('invalid_time')->nullable()->comment('失效时间');
            $table->ipAddress('ip')->default('0.0.0.0')->comment('登陆IP');
            $table->timestamp('login_time')->nullable()->comment('登陆时间');
            $table->timestamp('last_login_time')->nullable()->comment('最后一次登陆');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
