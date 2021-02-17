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



$url = "https://jsonplaceholder.typicode.com/albums";

/**
* Send a GET requst using cURL
* @param string $url to request
* @param array $get values to send
* @param array $options for cURL
* @return string
*/
function curl_get($url, array $get = NULL, array $options = array())
{   
    $defaults = array(
        CURLOPT_URL => $url,
        CURLOPT_HEADER => 0,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_TIMEOUT => 4,
        CURLOPT_SSL_VERIFYPEER => false
    );
   
    $ch = curl_init();
    curl_setopt_array($ch, ($options + $defaults));
    if( ! $result = curl_exec($ch))
    {
        trigger_error(curl_error($ch));
    }
    curl_close($ch);
    return $result;
}


$photos = curl_get($url);

$json_photos = json_decode($photos, true);

foreach ($json_photos as $photo) {
  echo $photo['id'];
  echo "\n";
}

// var_dump(json_decode($photos, true));


// foreach ($photos[0] as $photo) {
//   echo $photo;
//   echo "\n";
// }




//https://api.getaddress.io/find/sw1a2aa?expand=true&api-key=J5-Q1p37qE-34kThfUkGMw30248
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, "https://jsonplaceholder.typicode.com/photos");
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS, POST DATA);
// $result = curl_exec($ch);


// print_r($result);
// curl_close($ch);

?>

<html >
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap-grid.css">
    <link rel="stylesheet" href="../CSS/my_css.css">
    <body style="margin:10px;">
    <a href="test_get.php?subject=PHP&web=W3schools.com">Test $GET</a>

    </body>
</html>

<style>
    body{
    }

    #system-background {
        background-color:#ff6600;
    }

    .center {
        margin: auto;
        width: 50%;
    }

    #heading-box{
        background-color:#ff6600;
        border: 3px solid blue;
        padding: 10px;
    }

    #main-box {
        padding: 13px;
    }
    
    .text-center {
        text-align:center;
        font-family: sans-serif;
    }
    .button {
        background-color: #ff6600; /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
    }
</style>

