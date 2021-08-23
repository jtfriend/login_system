<?php
require_once '../core/init.php';

// if (Session::exists('jtf3')) {
//     echo '<p>'. Session::flash('home') . '</p>';
//     echo "session exists";
// } else {
//     echo "no session exists";
// }

$user = new User();

$string = file_get_contents("../cars/car_collection.json");
$json_data = json_decode($string, true);


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//#e67300

// echo ($_POST["make"]);
// echo ($_POST["actual"]);

if ($user->isLoggedIn()) {

  if ((!isset($_REQUEST["make"])) || (!isset($_REQUEST["make"])) || (!isset($_REQUEST["version"])) || (!isset($_REQUEST["actual"]))) {
    echo "Fail";
  }

  $make = $_REQUEST["make"];
  $model = $_REQUEST["model"];
  $version = $_REQUEST["version"];
  $actual = $_REQUEST["actual"];

  $string_to_check = strtolower($make) . "-" . strtolower($model) . "-" . strtolower($version);

  if ($actual == $string_to_check) {
    echo "1";
    // echo $actual . " = " . $string_to_check;
  } else {
    echo "0";
  }




  // Redirect::to("../cars/game.php");
}

