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

if ($user->isLoggedIn()) {

  if (isset($_REQUEST["make"])) {
    $make = $_REQUEST["make"];

    foreach ($json_data as $carMake => $carModelList) {
      if ($carMake == $make) {
        foreach ($carModelList as $carModel => $versionList) {
          $modelList[] = $carModel;
        }
      }
    }
    echo json_encode($modelList);
  }

  if (isset($_REQUEST["model"])) {
    $model = $_REQUEST["model"];
    foreach ($json_data as $carMake => $carModelList) {
      foreach ($carModelList as $carModel => $versionList) {
        if ($carModel == $model) {
          foreach ($versionList as $carVersion => $carVersionData) {
            $versionListSend[] = $carVersion;
          }
        }
      }
    }
    echo json_encode($versionListSend);
  }
  
  // $user->delete($id);
  
  // echo "connection made :" . $id;
  // return "Fiesta";
  // Redirect::to("../cars/game.php");
}