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
        Schema::create('goods_attrs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('store_id')->default(0)->comment('所属店铺');
            $table->string('name', 20)->default('')->comment('属性名称');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods_attrs');
    }
};
