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
        Schema::create('advs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('belong_id')->default(0)->comment('所属用户');
            $table->unsignedInteger('pid')->default(0)->comment('广告位');
            $table->string('name', 25)->default('')->comment('广告名称');
            $table->string('url', 150)->default('')->comment('链接');
            $table->string('image', 150)->default('')->comment('图片地址');
            $table->timestamp('adv_start')->default(now())->comment('开始时间');
            $table->timestamp('adv_end')->default(now()->addDay())->comment('结束时间');
            $table->unsignedTinyInteger('is_sort')->default(0)->comment('排序');
            $table->unsignedTinyInteger('is_type')->default(0)->comment('类型');
            $table->unsignedTinyInteger('status')->default(0)->comment('状态');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advs');
    }
};
