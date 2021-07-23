<?php
require_once '../core/init.php';

// if (Session::exists('jtf3')) {
//     echo '<p>'. Session::flash('home') . '</p>';
//     echo "session exists";
// } else {
//     echo "no session exists";
// }

$user = new User();


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//#e67300

if ($user->isLoggedIn()) {
  $id = $_REQUEST["id"];

  $user->delete($id);

  echo "connection made" . $id;
  
  Redirect::to("../super.php");
}



