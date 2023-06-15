<?php
return [
    'name' => env('CRONTAB.NAME', 'think-crontab'),
    'user' => env('CRONTAB.USER', 'www'),
    'group' => env('CRONTAB.GROUP', 'www'),
    'logfile' => runtime_path() . 'crontab.log',
    'pidfile' => runtime_path() . 'crontab.pid',
    'handlers' => [
        // 
    ],
];