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
        Schema::create('user_checks', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->default(0)->comment('用户');
            $table->string('name', 20)->comment('名称');
            $table->string('card_no', 30)->comment('身份证号');
            $table->string('card_t', 150)->comment('身份证图片上');
            $table->string('card_b', 150)->comment('身份证图片下');
            $table->string('bank_no', 30)->comment('银行卡号');
            $table->string('bank_name', 30)->comment('银行名称');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_checks');
    }
};
