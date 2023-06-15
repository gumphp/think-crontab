<?php
namespace gumphp\crontab;

use think\Service;
class CrontabService extends Service
{
    public function register(): void
    {
        
    }

    public function boot(): void
    {
        $this->commands([
            \gumphp\crontab\command\CrontabCommand::class,
        ]);
    }
}