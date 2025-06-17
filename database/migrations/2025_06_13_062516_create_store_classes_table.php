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
        Schema::create('store_classes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('store_id')->default(0)->comment("店铺ID");
            $table->text('class_id')->comment("栏目ID");
            $table->text('class_name')->comment("栏目名称");
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_classes');
    }
};
