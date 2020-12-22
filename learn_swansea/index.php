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

?>

<html id="system-background">
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap-grid.css">
    <link rel="stylesheet" href="../CSS/my_css.css">
    <body style="margin:10px;">


    </body>
</html>

<style>
    body{
        background-image: url("swansea_area1");
        background-repeat: no-repeat, repeat;
        background-color: #cccccc;
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

