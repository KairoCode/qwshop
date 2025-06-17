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
        Schema::create('goods_specs', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('attr_id')->default(0)->comment('所属属性');
            $table->string('name', 20)->default('')->comment('规格名称');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goods_specs');
    }
};
