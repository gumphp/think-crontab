<?php
namespace gumphp\crontab\command;

use gumphp\crontab\CrontabInterface;
use think\console\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\input\Option;
use think\console\Output;
use Workerman\Crontab\Crontab;
use Workerman\Worker;

class CrontabCommand extends Command
{
    protected $config;

    protected function configure()
    {
        // 指令配置
        $this->setName('crontab')
            ->setDescription('crontab base on workerman')
            ->addArgument('action', Argument::OPTIONAL, 'action:start|stop|restart|reload|status', 'start')
            ->addOption('daemon', 'd', Option::VALUE_NONE, 'daemonize: --daemon or -d')
        ;
    }

    protected function execute(Input $input, Output $output)
    {
        $this->init();

        $worker = new Worker();
        $worker->count = 1;
        $worker->name = $this->config['name'];
        $worker->user = $this->config['user'];
        $worker->group = $this->config['group'];
        $worker->onWorkerStart = function () use ($output) {

            $crontabs = $this->config['handlers'];
            foreach ($crontabs as $crontabClass) {

                if (!class_exists($crontabClass)) {
                    $output->error('class ' . $crontabClass . ' not exists');
                    continue;
                }
                $crontab = new $crontabClass;

                new Crontab($crontab->getRule(), [$crontab, 'handle']);
            }
        };

        Worker::$logFile = $this->config['logfile'];
        Worker::$pidFile = $this->config['pidfile'];
        Worker::$processTitle = $this->config['name'];
        if ($input->getOption('daemon')) {
            Worker::$daemonize = true;
        }

        Worker::runAll();
    }

    protected function init()
    {
        date_default_timezone_set(config('app.default_timezone'));
        $this->config = config('crontab');
    }
}
