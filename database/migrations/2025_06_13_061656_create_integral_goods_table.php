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
        Schema::create('integral_goods', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('cid')->default(0)->comment('栏目ID');
            $table->string('goods_name', 120)->comment('商品名');
            $table->string('goods_subname', 120)->comment('副标题');
            $table->decimal('goods_price', 9)->default(0.00)->comment('积分');
            $table->decimal('goods_market_price', 9)->default(0.00)->comment('市场金额');
            $table->unsignedInteger('goods_stock')->default(0)->comment('库存');
            $table->text('goods_images', 150)->comment('商品图片');
            $table->string('goods_master_image', 150)->default('')->comment('主图');
            $table->unsignedInteger('goods_sale')->default(0)->comment('销售量');
            $table->unsignedTinyInteger('goods_status')->default(0)->comment('上下架');
            $table->unsignedTinyInteger('is_recommend')->default(0)->comment('推荐');
            $table->text('goods_content')->comment('详情');
            $table->text('goods_content_mobile')->comment('手机端详情');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('integral_goods');
    }
};
