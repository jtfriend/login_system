<?php
require_once '../core/init.php';

$user = new User();

if ($user->isLoggedIn()) {
} else {
    Redirect::to( '../login.php');
}

$string = file_get_contents("data_my_lego.json");
$json_data = json_decode($string, true);

?>



<html id="system-background">
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap-grid.css">
    <link rel="stylesheet" href="../CSS/my_css.css">
    <body style="margin:10px;">
      <div id="heading-box" class="center">
        <div class="text-center" style="color:white;">LEGO COLLECTION</div>
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
          <?php foreach ($json_data as $lego_theme_name => $lego_box_theme) { ?>
            <div class="row" style="font-size: 20; font-weight: 500; padding:10px;">
                <div class="container-fluid">
                   <?php echo $lego_theme_name ?>
                </div>
                <?php foreach ($lego_box_theme as $x => $lego_box) {
                  $lego_box_name = $lego_box['name'];
                   ?>
                  <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 item-box">
                      <!-- <form style="" action="elf_rescue/index.php" method="post"> -->
                          <!-- <input type="hidden" name="username" value="<?php echo $user->data()->u_username; ?>"> -->
                          <div class=" h-10 justify-content-center" style="display:flex;flex-direction: column;">
                              <input class="boring_button" type="submit" value="<?php echo $lego_box_name ?>">
                          </div>
                          <img src="<?php echo "my_lego/" . $lego_theme_name . "-".  $lego_box_name . ".jpg"; ?>" style="width:auto;height:190px;" />
                      <!-- </form> -->
                  </div>
                <?php } ?>
            </div>
          <?php } ?>
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
        height:230px;
        margin-bottom: 15px;
        margin-top: 15px;
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

    img:hover {
        -webkit-transform:scale(1.5);
        transform:scale(1.5);
    }

    img {
        transition:transform 0.25s ease;
    }

</style>

