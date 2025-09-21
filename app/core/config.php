<?php
// Application and Database configuration
if (!defined('ROOT')) {
    define('ROOT', 'http://localhost:8080/task_manager/');
}
return [
    'base_url' => 'http://localhost:8080/task_manager/',
    'db' => [
        'host' => 'localhost',
        'name' => 'task_monitor',
        'user' => 'root',
        'pass' => ''
    ]
];
// Application and Database configuration
// if (!defined('ROOT')) {
//     define('ROOT', '/');
// }
// return [
//     'base_url' => '/',
//     'db' => [
//         'host' => 'localhost',
//         'name' => 'optisolu_apartment_management',
//         'user' => 'optisolu_admin',
//         'pass' => 'OpSol@2023'
//     ]
// ];
//  git config --global user.email "masumipe"
//   git config --global user.name "Mohammad Rashedul Islam"