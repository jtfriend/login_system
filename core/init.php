<?php
//setting up gitignore for use with raspberry pi
session_start();

$GLOBALS['config'] = [
    'mysql' => [
        'host'  => '127.0.0.1',
        'username'  => 'joseph',
        'password'  => 'iqblock',
        'db'  => 'login_system',
    ],
    'remember'  => [
        'cookie_name'   => 'hash',
        'cookie_expiry' => 604800,
    ],
    'session' => [
        'session_name' => 'user',
        'token_name'   => 'token',
    ],
];

spl_autoload_register(function($class) {
    require_once __DIR__ .'../../classes/' . $class . '.php';
});


require_once __DIR__ .'../../functions/sanitize.php';


// $GLOBALS['config'] = [
//     'mysql' => [
//         'host'  => '127.0.0.1',
//         'username'  => 'joseph',
//         'password'  => 'iqblock',
//         'db'  => 'elf_rescue',
//     ],
//     'remember'  => [
//         'cookie_name'   => 'hash',
//         'cookie_expiry' => 604800,
//     ],
//     'session' => [
//         'session_name' => 'user',
//         'token_name'   => 'token',
//     ],
// ];

?>
