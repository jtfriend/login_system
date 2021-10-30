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

$answer = null;

if ($user->isLoggedIn()) {

  if ((!isset($_REQUEST["make"])) || (!isset($_REQUEST["make"])) || (!isset($_REQUEST["version"])) || (!isset($_REQUEST["actual"]))) {
    echo "Fail";
  } else {

    $make = $_REQUEST["make"];
    $model = $_REQUEST["model"];
    $version = $_REQUEST["version"];
    $actual = $_REQUEST["actual"];

    $db = new DB();
    $your_answer = $db->get('cars', [
      ['c_make', '=', urldecode($make)],
      ['c_model', '=', urldecode($model)],
      ['c_version', '=', urldecode($version)]
    ]);

    $your_answer_results = $db->results();
    $pieces_correct_answer = explode("-", $actual);

    $correct_answer = $db->get('cars', [
      ['c_make', '=', ucwords(urldecode($pieces_correct_answer[0]),' ')],
      ['c_model', '=', ucwords(urldecode($pieces_correct_answer[1]),' ')],
      ['c_version', '=', ucwords(urldecode($pieces_correct_answer[2]),' ')]
    ]);

    $correct_answer_results = $db->results();

    if ($your_answer_results[0]->c_id == $correct_answer_results[0]->c_id) {
      $answer = 1;
      echo "1";
    } else {
      $answer = 0;
      echo "0";
    }

    $carGameAnswer = new Answer();
    try {
        $carGameAnswer->create([
            'a_value'             => $answer,
            'a_uid'               => $user->data()->u_id,
            'a_your_answer_cid'    => $your_answer_results[0]->c_id,
            'a_correct_answer_cid' => $correct_answer_results[0]->c_id
        ]);
        // echo("Added answer");

    } catch (Exception $e) {
        die($e->getMessage());
    }

    $past_answers = $db->get('answers', [
      ['a_uid', '=', $user->data()->u_id]
    ]);

    $past_answers_results = $past_answers->results();

    var_dump($past_answers_results);

    echo json_encode($past_answers_results);



  }
}

