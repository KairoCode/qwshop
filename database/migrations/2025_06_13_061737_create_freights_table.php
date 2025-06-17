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
        Schema::create('freights', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('store_id')->default(0)->comment('店铺ID');
            $table->string('name', 80)->default('默认运费')->comment('标题');
            $table->decimal('f_weight', 6)->default(0.00)->comment('首重');
            $table->decimal('f_price', 6)->default(0.00)->comment('首重运费');
            $table->decimal('o_weight', 6)->default(0.00)->comment('超出重量每多少');
            $table->decimal('o_price', 6)->default(0.00)->comment('超出重量每次多少钱');
            $table->text('area_id')->comment('内容ID');
            $table->text('area_name')->comment('内容中文');
            $table->unsignedTinyInteger('is_type')->default(0)->comment('0默认运费 1 配置运费');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freights');
    }
};
