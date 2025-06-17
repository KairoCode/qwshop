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
        Schema::create('notices', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('belong_id')->default(0)->comment('所属用户');
            $table->string('tag', 20)->default('')->comment('标签');
            $table->string('name', 35)->default('')->comment('标题');
            $table->text('content')->comment('内容');
            $table->unsignedTinyInteger('is_type')->default(0)->comment('类型');
            $table->unsignedTinyInteger('is_send')->default(0)->comment('发送状态');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notices');
    }
};
