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
        Schema::create('file_spaces', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('belong_id')->default(0)->comment('所属ID');
            $table->unsignedInteger('dir_id')->default(0)->comment('所属文件夹');
            $table->string('name', 30)->default('filename')->comment('源文件名');
            $table->string('new_name', 30)->default('filename')->comment('新文件名');
            $table->string('md5', 32)->default('')->comment('md5值');
            $table->string('url', 150)->default('')->comment('文件地址');
            $table->string('ext_name', 20)->default('ext_name')->comment('文件后缀');
            $table->string('disk_name', 15)->default('public')->comment('存储位置');
            $table->string('info', 30)->default('0*0')->comment('文件信息');
            $table->unsignedTinyInteger('status')->default(0)->comment('状态');
            $table->unsignedTinyInteger('is_type')->default(0)->comment('上传类型 1分片');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file_spaces');
    }
};
