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
        Schema::create('goods_classes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('pid')->default(0)->commentg('父栏目ID');
            $table->string('thumb', 150)->default('')->commentg('缩略图');
            $table->string('name', 20)->default('')->comment('栏目名称');
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
        Schema::dropIfExists('goods_classes');
    }
};
