<?php
namespace gumphp\crontab;

interface CrontabInterface
{
    public function getRule();

    public function handle();
}