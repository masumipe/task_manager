<?php
// Application and Database configuration
if (!defined('ROOT')) {
    define('ROOT', 'http://localhost/task_manager/');
}
return [
    'base_url' => 'http://localhost/task_manager/',
    'db' => [
        'host' => 'localhost',
        'name' => 'task_monitor',
        'user' => 'root',
        'pass' => ''
    ]
];