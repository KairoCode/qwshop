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
        Schema::create('goods_skus', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('goods_id')->default(0)->comment('商品ID');
            $table->text('spec_id')->comment('规格ID');
            $table->string('sku_name', 60)->default('')->comment('SKU名称');
            $table->string('goods_image')->default('')->comment('主图');
            $table->decimal('goods_price', 9)->default(0.00)->comment('商品价格');
            $table->decimal('goods_market_price', 9)->default(0.00)->comment('市场价格');
            $table->unsignedInteger('currency_id')->default(1)->comment('货币类型');
            $table->unsignedInteger('goods_stock')->default(0)->comment('库存');
            $table->decimal('goods_weight', 9)->default(0)->comment('商品重量');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods_skus');
    }
};
