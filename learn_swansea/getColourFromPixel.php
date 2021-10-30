<?php
require_once '../core/init.php';

// if (Session::exists('jtf3')) {
//     echo '<p>'. Session::flash('home') . '</p>';
//     echo "session exists";
// } else {
//     echo "no session exists";
// }

$user = new User();


if ($user->isLoggedIn()) {

  $json = filter_input(INPUT_POST, 'json');
  $decoded_json = json_decode($json);
  $xCoord = $decoded_json->xCoord;
  $yCoord = $decoded_json->yCoord;

  $im = ImageCreateFromPng("swansea_area4.png");
  $rgb = ImageColorAt($im, $xCoord, $yCoord);
  $r = ($rgb >> 16) & 0xFF;
  $g = ($rgb >> 8) & 0xFF;
  $b = $rgb & 0xFF;

  echo "rgb(" . $r . "," . $g . "," . $b . ")";


  // var_dump($decoded_json, $xCoord);
}

