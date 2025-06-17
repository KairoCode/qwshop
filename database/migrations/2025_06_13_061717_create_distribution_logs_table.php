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
        Schema::create('distribution_logs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30)->default('分销')->comment('标题');
            $table->unsignedInteger('user_id')->default(0)->comment('用户ID');
            $table->unsignedInteger('store_id')->default(0)->comment('店铺ID');
            $table->unsignedInteger('order_id')->default(0)->comment('订单ID');
            $table->unsignedInteger('distribution_id')->default(0)->comment('分销活动ID');
            $table->unsignedInteger('order_goods_id')->default(0)->comment('订单商品ID');
            $table->decimal('money', 9)->default(0.00)->comment('分销金额');
            $table->decimal('lev', 6)->default(0.00)->comment('分佣率');
            $table->decimal('commission', 9)->default(0.00)->comment('分佣金额');
            $table->unsignedTinyInteger('status')->default(0)->comment('处理结果 0 等待分佣 1 分佣');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distribution_logs');
    }
};
