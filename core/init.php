<?php
//setting up gitignore for use with raspberry pi
session_start();

$GLOBALS['config'] = [
    'mysql' => [
        'host'  => '127.0.0.1',
        'username'  => 'root',
        'password'  => '',
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


require_once __DIR__ .'../../functions/all.php';

if (Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))) {
    $hash = Cookie::get(Config::get('remember/cookie_name'));
    $hashCheck = DB::getInstance()->get('users_session', ['us_hash','=',$hash]);

    if ($hashCheck->count()) {
        $user = new User($hashCheck->first()->us_uid);
        $user->login();
    }
}

?>
