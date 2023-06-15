## 安装
> composer require gumphp/think-crontab

## 使用

```php
<?php
namespace app\crontab;

use gumphp\crontab\Crontab;

class Test extends Crontab
{
    // 每秒执行一次
    protected $rule = '* * * * * *';
    
    public function handle()
    {
        $message = __METHOD__ . "\t" . date('Y-m-d H:i:s') . PHP_EOL;
        error_log($message, 3, runtime_path() . 'debug.log');
    }
}
```

> 把 `Test` 加入 `config/crontab.php` 的 `handlers` 配置

```php
<?php
return [
    # ...
    'handlers' => [
        \app\crontab\Test::class,
    ],
];
```

**启动守护进程**
```bash
php think crontab start
```