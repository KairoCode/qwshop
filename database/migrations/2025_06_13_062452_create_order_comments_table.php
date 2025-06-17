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
        Schema::create('order_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->default(0)->comment('用户ID');
            $table->unsignedInteger('order_id')->default(0)->comment('订单ID');
            $table->unsignedInteger('goods_id')->default(0)->comment('商品ID');
            $table->unsignedInteger('store_id')->default(0)->comment('店铺ID');
            $table->decimal('score', 5)->default(5.00)->comment('综合评分');
            $table->decimal('agree', 5)->default(5.00)->comment('描述相符');
            $table->decimal('service', 5)->default(5.00)->comment('服务态度');
            $table->decimal('speed', 5)->default(5.00)->comment('发货速度');
            $table->text('reply')->comment('回复内容');
            $table->timestamp('reply_time')->default(now())->comment('回复时间');
            $table->text('content')->comment('内容');
            $table->text('image')->comment('图片逗号隔开');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_comments');
    }
};
