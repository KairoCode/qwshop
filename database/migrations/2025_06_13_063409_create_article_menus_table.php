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
        Schema::create('article_menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('belong_id')->default(0)->comment('所属用户');
            $table->unsignedInteger('pid')->default(0)->comment('上级ID');
            $table->string('name', 35)->default('')->comment('栏目名称');
            $table->unsignedTinyInteger('is_sort')->default(0)->comment('排序');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('article_menus');
    }
};
