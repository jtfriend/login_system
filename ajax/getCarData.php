<?php
require_once '../core/init.php';

// if (Session::exists('jtf3')) {
//     echo '<p>'. Session::flash('home') . '</p>';
//     echo "session exists";
// } else {
//     echo "no session exists";
// }

$user = new User();


// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
//#e67300


$db = new DB();
$db->getAllFromTable('cars', 'c_id', 'ASC', 50);

$carArray = $db->results();

// var_dump($carArray);

$randomNum = rand(0, count($carArray)-1);

if ($user->isLoggedIn()) {
  $modelList = [];
  $versionList = [];

  if (isset($_REQUEST["make"])) {
    $make = $_REQUEST["make"];

    foreach ($carArray as $car) {
      if (ucfirst($car->c_make) == $make) {
        if (!in_array(ucfirst($car->c_model), $modelList)) {
          $modelList[] = ucfirst($car->c_model);
        }
      }
    }
    echo json_encode($modelList);
  }

  if (isset($_REQUEST["model"])) {
    $model = $_REQUEST["model"];

    foreach ($carArray as $car) {
      if (ucfirst($car->c_model) == $model) {
        if (!in_array(ucfirst($car->c_version), $versionList)) {
          $versionList[] =  ucfirst($car->c_version);
        }
      }
    }
    echo json_encode($versionList);
  }
}