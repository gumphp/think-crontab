<?php
namespace gumphp\crontab;

class Crontab implements CrontabInterface
{
    /**
     * @var string
     */
    protected $rule = '* * * * * *';

    /**
     * @return string
     */
    public function getRule()
    {
        return $this->rule;
    }

    public function handle()
    {

    }
}