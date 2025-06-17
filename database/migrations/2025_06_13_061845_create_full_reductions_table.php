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
        Schema::create('full_reductions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('store_id')->default(0)->comment('店铺ID');
            $table->string('name', 10)->default('')->comment('名称');
            $table->decimal('money', 6)->default(0.00)->comment('满减金额');
            $table->decimal('use_money', 9)->default(0.00)->comment('满足金额');
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
        Schema::dropIfExists('full_reductions');
    }
};
