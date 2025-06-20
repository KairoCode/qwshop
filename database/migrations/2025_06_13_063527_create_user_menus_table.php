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
        Schema::create('user_menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('pid')->default(0)->comment('上级ID');
            $table->string('name', 35)->default('')->comment('菜单名称');
            $table->string('ename', 35)->default('')->comment('英文名称');
            $table->string('icon', 20)->default('')->comment('图标');
            $table->string('apis', 80)->default('')->comment('菜单路由');
            $table->string('view', 40)->default('')->comment('前端视图');
            $table->unsignedTinyInteger('is_open')->default(0)->comment('外链跳转');
            $table->string('content', 40)->default('')->comment('菜单描述');
            $table->unsignedInteger('is_sort')->default(0)->comment('排序');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_menus');
    }
};
