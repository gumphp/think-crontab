<?php
namespace gumphp\crontab\command;

use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;

class CrontabCommand extends Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('crontab')
            ->setDescription('crontab base on workerman');
    }

    protected function execute(Input $input, Output $output)
    {
        // 指令输出
        $output->writeln('Gumphp\ThinkCrontab\command\CrontabCommand');
    }
}
