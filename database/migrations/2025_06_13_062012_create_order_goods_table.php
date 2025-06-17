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
        Schema::create('order_goods', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('order_id')->default(0)->comment('订单ID');
            $table->unsignedInteger('sku_id')->default(0)->comment('SKUID');
            $table->unsignedInteger('goods_id')->default(0)->comment('商品ID');
            $table->unsignedInteger('user_id')->default(0)->comment('用户ID');
            $table->unsignedInteger('store_id')->default(0)->comment('店铺ID');
            $table->string('goods_name', 120)->default('')->comment('商品名称');
            $table->string('goods_image', 150)->default('')->comment('商品图片');
            $table->string('sku_name', 30)->default('')->comment('SKU 名称');
            $table->unsignedInteger('buy_num')->default(1)->comment('购买数量');
            $table->decimal('total_price', 9)->default(0.00)->comment('总价格');
            $table->decimal('goods_price', 9)->default(0.00)->comment('商品单价');
            $table->unsignedInteger('currency_id')->default(1)->comment('货币类型');
            $table->decimal('total_weight', 6)->default(0.00)->comment('总重量');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_goods');
    }
};
