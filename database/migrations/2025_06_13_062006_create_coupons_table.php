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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('store_id')->default(0)->comment('店铺ID');
            $table->string('name', 10)->default('')->comment('名称');
            $table->decimal('money', 6)->default(0.00)->comment('优惠券金额');
            $table->decimal('use_money', 9)->default(0.00)->comment('允许使用金额');
            $table->unsignedInteger('stock')->default(10)->comment('优惠券数量');
            $table->string('content', 30)->default('')->comment('优惠券描述');
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
        Schema::dropIfExists('coupons');
    }
};
