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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 30)->default('名称')->comment('标题');
            $table->string('ename', 20)->default('zh-cn')->comment('多语种标识');
            $table->string('currency', 20)->default('￥')->comment('货币符号');
            $table->string('currency_ename', 20)->default('RMB')->comment('支付标识');
            $table->text('content')->comment('描述');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
