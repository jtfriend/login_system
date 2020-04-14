<?php
require_once '../core/init.php';


$user = new User();

if ($user->isLoggedIn()) {
    if (isset($_POST['username'])) {
    } else {
        Redirect::to( '../index.php');
    }
} else {
    Redirect::to( '../login.php');
}

$dbUser = new DB();
$userData = $dbUser->get("users", ["u_username", "=", isset($_POST['username']) ? $_POST['username'] : ""]);

$userObjData = get_object_vars($userData->_results[0]);

$insert = $dbUser->insert('scores',[
    's_uid' => $userObjData['u_id'],
    's_value' => $_POST['score']
]);


?>