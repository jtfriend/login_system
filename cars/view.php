<?php
require_once '../core/init.php';

$user = new User();

if ($user->isLoggedIn()) {
} else {
    Redirect::to( '../login.php');
}

$string = file_get_contents("car_collection.json");
$json_data = json_decode($string, true);

//Get data from Database to be displayed

$db = new DB();
$db->getAllFromTable('cars', 'c_make, c_model', 'ASC', 50);

$carArray = $db->results();

$oldCarMake = "";

?>

<html id="system-background">
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap-grid.css">
    <link rel="stylesheet" href="../CSS/my_css.css">
    <body>
      <div style="background-color:#ffffff; height:100%;">
        <div class="container-fluid bg-dark">
            <div class="row justify-content-md-center bg-blue text-white" style="padding:20px;">
                <div style="text-align: center;" class="col-sm">Hello <a href=""><?php echo escape($user->data()->u_username); ?></a>!</div>
                <div style="text-align: center;" class="col-sm"><a href="view.php">Cars</a></div>
                <div style="text-align: center;" class="col-sm"><a href="game.php">Play Game</a></div>
                <div style="text-align: center;" class="col-sm"><a href="create.php">Add Car</a></div>
            </div>
        </div>
        <div class="container" style="background-color:gray;">
            <div class="row" style="font-size: 20; font-weight: 500; padding:10px;">
                <?php foreach ($carArray as $carItem) { ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 item-box border">
                    <a id="clickable_div" href="details?make=<?php echo strtolower($carItem->c_make) . "&model=". strtolower($carItem->c_model) . "&version=". strtolower($carItem->c_version) ?>"></a>
                    <div class=" h-10 justify-content-center" style="display:flex;flex-direction: column;">
                        <input class="boring_button" type="submit" value="">
                    </div>
                    <img src="<?php 
                        echo "uploads/" .  
                        strtolower($carItem->c_make) . 
                        "-" . 
                        strtolower($carItem->c_model) . 
                        "-" . 
                        strtolower($carItem->c_version) . 
                        ".jpeg"; ?>" style="width:auto;height:100px;" />
                </div>
                <?php } ?>
            </div>
        </div>
    </body>
</html>

<?php if ($oldCarMake = $carItem->c_make) {

}
 
$oldCarMake = $carItem->c_make;
?>

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

