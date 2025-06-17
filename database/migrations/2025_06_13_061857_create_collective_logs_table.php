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
        Schema::create('collective_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('collective_id')->default(0)->comment('团ID');
            $table->unsignedInteger('user_id')->default(0)->comment('用户ID');
            $table->unsignedInteger('store_id')->default(0)->comment('店铺ID');
            $table->unsignedInteger('goods_id')->default(0)->comment('商品ID');
            $table->decimal('discount', 6)->default(0.00)->comment('折扣');
            $table->unsignedTinyInteger('need')->default(5)->comment('需要人数');
            $table->unsignedTinyInteger('status')->default(2)->comment('状态 0取消 1完成  2 拼团中');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collective_logs');
    }
};
