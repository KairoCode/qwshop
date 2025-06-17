<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class MySqlCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cloudErp:mysql';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cloud Erp Install MySQL Command';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Artisan::call('migrate:reset'); // 先清空
        Artisan::call('migrate'); // 迁移
//        // 获取数据库配置
//        $dbUser = escapeshellarg(env('DB_USERNAME'));
//        $dbPass = escapeshellarg(env('DB_PASSWORD'));
//        $dbHost = escapeshellarg(env('DB_HOST'));
//        $dbPort = escapeshellarg(env('DB_PORT'));
//        $dbName = escapeshellarg(env('DB_DATABASE'));
//        $sqlFile = escapeshellarg(
//            app_path('Console' . DIRECTORY_SEPARATOR . 'Commands' . DIRECTORY_SEPARATOR . 'cloudErp.sql')
//        );
//        // 构建安全的命令
//        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
//            // Windows 系统
//            $command = "type {$sqlFile} | mysql -u{$dbUser} -p{$dbPass} -h{$dbHost} -P{$dbPort} {$dbName}";
//        } else {
//            // Linux/Mac 系统
//            $command = "cat {$sqlFile} | mysql -u{$dbUser} -p{$dbPass} -h{$dbHost} -P{$dbPort} {$dbName}";
//        }
//        // 执行命令并获取返回值
//        $output = null;
//        $resultCode = null;
//        exec($command, $output, $resultCode);
//
//        // 检查结果
//        if ($resultCode !== 0) {
//            throw new \Exception("SQL 导入失败 (错误码: {$resultCode})。输出: " . implode("\n", $output));
//        }
//
//        $this->info('SQL 文件成功导入');
        // // 例1 导入sql有点慢试试这个新办法 没试过不知可行不可行，暂时先注释 ChatGPT3.5 给出的优化方案
        // DB::disconnect();
        // $systemCmd = 'mysql -u' . env('DB_USERNAME') . ' -p' . env('DB_PASSWORD') . ' -h '.env('DB_HOST').' -P '.env('DB_PORT').' ' . env('DB_DATABASE') . ' < ' . app_path('Console' . DIRECTORY_SEPARATOR . 'Commands' . DIRECTORY_SEPARATOR . 'cloudErp.sql');
        // system($systemCmd);
        // // 例2
//         DB::unprepared('system mysql -u' . env('DB_USERNAME') . ' -p' . env('DB_PASSWORD') . ' -h '.env('DB_HOST').' -P '.env('DB_PORT').' ' . env('DB_DATABASE') . ' < ' . app_path('Console' . DIRECTORY_SEPARATOR . 'Commands' . DIRECTORY_SEPARATOR . 'cloudErp.sql'));
        DB::unprepared(file_get_contents(app_path('Console' . DIRECTORY_SEPARATOR . 'Commands' . DIRECTORY_SEPARATOR . 'cloudErp.sql'))); // 直接执行sql文件 导入数据
    }
}
