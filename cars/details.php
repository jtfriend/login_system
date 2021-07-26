<?php
require_once '../core/init.php';

$user = new User();

if ($user->isLoggedIn()) {
} else {
    Redirect::to( '../login.php');
}

$string = file_get_contents("car_collection.json");
$json_data = json_decode($string, true);

$carMake = htmlspecialchars($_GET["make"]);
$carModel = htmlspecialchars($_GET["model"]);
$carVersion = htmlspecialchars($_GET["version"]);



?>



<html id="system-background">
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap-grid.css">
    <link rel="stylesheet" href="../CSS/my_css.css">
    <body style="margin:10px;">
      <div id="heading-box" class="center">
        <div class="text-center" style="color:white;">Cars</div>
      </div>
      <div style="background-color:#ffffff; height:100%;">
        <div class="container-fluid bg-dark">
            <div class="row justify-content-md-center bg-blue text-white" style="padding:20px;">
                <div style="text-align: center;" class="col-sm">Hello <a href="#"><?php echo escape($user->data()->u_username); ?></a>!</div>
                <div style="text-align: center;" class="col-sm"></div>
                <div style="text-align: center;" class="col-sm"><a href="logout.php">Log out</a></div>
            </div>
        </div>
        <div class="container" style="background-color:gray;">
            <div class="row" style="font-size: 20; font-weight: 500; padding:10px;">
                <div class="container-fluid">
                   <?php echo ucfirst($carMake) ?>
                </div>
            </div>
            <div class="row" style="font-size: 20; font-weight: 500; padding:10px;">
                <div class="container-fluid">
                    <?php echo $carModel ?>
                </div>
                <div class="col-sm-4 item-box-details ">
                <table>
                    <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Age</th>
                    </tr>
                    <tr>
                        <td>Jill</td>
                        <td>Smith</td>
                        <td>50</td>
                    </tr>
                    <tr>
                        <td>Eve</td>
                        <td>Jackson</td>
                        <td>94</td>
                    </tr>
                </table>
                </div>
                <div class="col-sm-8 item-box-details ">
                    <img src="<?php 
                    echo "car_collection_images/" .  
                    strtolower($carMake) . 
                    "-" . 
                    strtolower($carModel) . 
                    "-" . 
                    strtolower($carVersion) . 
                    ".jpeg"; ?>" style="width:auto;height:300px;" />
                </div>
        </div>

        <!-- <img src="<?php echo $image; ?>" style="width:304px;height:228px;" /> -->
    </body>
</html>

<style>
    #system-background {
        background-color:"white";
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

    #clickable_div {
        position:absolute; 
        width:100%;
        height:100%;
        top:0;
        left: 0;
        z-index: 1;
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

    .home_button {
        position:fixed;
        background-color: #ff6600; /* Green */
        border: none;
        color: white;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
    }

    .item-box {
        padding-right: 10px;
        padding-left: 10px;
        text-align:center;
        height:144px;
        margin-bottom: 15px;
        margin-top: 15px;
        /* border-style: solid; */
        grid-gap: 1px;
    }

    .item-box-details {
        padding-right: 10px;
        padding-left: 10px;
        text-align:center;
        height:318px;
        margin-bottom: 15px;
        margin-top: 15px;
        /* border-style: solid; */
        grid-gap: 1px;
    }

    .item-box img {
        max-width: 100%;
    }

    a {
        color:white;
    }

    a:hover {
        color: white;
        text-decoration:inherit;
    }

    .boring_button {
        background-color: Transparent;
        background-repeat: no-repeat;
        border: none;
        cursor: pointer;
        overflow: hidden;
        color:black;
        font-size: 16px;
    }

    .box-1 {
        border-style: solid;
        border-width: 3px;
    }

    /* img:hover {
        -webkit-transform:scale(1.5);
        transform:scale(1.5);
    }

    img {
        transition:transform 0.25s ease;
    } */

</style>

