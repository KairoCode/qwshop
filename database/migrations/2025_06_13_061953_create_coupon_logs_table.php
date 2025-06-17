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
        Schema::create('coupon_logs', function (Blueprint $table) {
            $table->id();
            $table->string('name', '30')->default('优惠券')->comment('标题');
            $table->unsignedInteger('coupon_id')->default(0)->comment('优惠券ID');
            $table->unsignedInteger('user_id')->default(0)->comment('用户ID');
            $table->unsignedInteger('store_id')->default(0)->comment('店铺ID');
            $table->unsignedInteger('order_id')->default(0)->comment('订单ID');
            $table->decimal('money', 9)->default(0.00)->comment('优惠券金额');
            $table->decimal('use_money', 6)->default(0.00)->comment('允许使用金额');
            $table->unsignedTinyInteger('status')->default(0)->comment('状态 0未使用 1使用');
            $table->timestamp('start_time')->default(now())->comment('开始时间');
            $table->timestamp('end_time')->default(now()->addDays(5))->comment('结束');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupon_logs');
    }
};
