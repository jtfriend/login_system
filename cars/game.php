<?php
require_once '../core/init.php';

$user = new User();

if ($user->isLoggedIn()) {
} else {
    Redirect::to( '../login.php');
}

$string = file_get_contents("car_collection.json");
$json_data = json_decode($string, true);


foreach ($json_data as $carMake => $carModelList) {
  $carMakeList[] = $carMake;
}

var_dump($carMakeList);
// $carMakeRec = htmlspecialchars($_GET["make"]);
// $carModelRec = htmlspecialchars($_GET["model"]);
// $carVersionRec = htmlspecialchars($_GET["version"]);



?>


<html id="system-background">
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap-grid.css">
    <script src="../node_modules/jquery/dist/jquery.js"></script>
    <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <link rel="stylesheet" href="../CSS/my_css.css">
    <body>
      <div style="background-color:#ffffff; height:100%;">
        <div class="container-fluid bg-dark">
            <div class="row justify-content-md-center bg-blue text-white" style="padding:20px;">
                <div style="text-align: center;" class="col-sm">Hello <a href="#"><?php echo escape($user->data()->u_username); ?></a>!</div>
                <div style="text-align: center;" class="col-sm"></div>
            </div>
        </div>
        <div class="container" style="background-color:gray;">
            <div class="row" style="font-size: 20; font-weight: 500; padding:10px;">
              <div class="container-fluid">
                <h3><a href="index.php">< Back</a> </h3>
              </div>
              <div class="container-fluid">
                <h1> Game </h1>
              </div>
            </div>
            <div class="row" style="font-size: 20; font-weight: 500; padding:10px;">
              <div class="col-sm-12 item-box-details ">
                <img src="<?php echo "car_collection_images/ford-fiesta-mk1.jpeg"; ?>" style="width:auto;height:300px;" />
              </div>
            </div>
            <form action='ajax/delete_user.php?>' method="post">
              <div class="form-row">
                <div class="form-group col-sm-4">
                  <label for="inputMake">Make</label>
                  <select id="inputMake" class="form-control">
                    <option selected>Choose...</option>
                    <?php foreach ($json_data as $carMake => $carModelList) { ?>
                      <option><?php echo $carMake ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-sm-4">
                  <label for="inputModel">Model</label>
                  <select id="inputModel" class="form-control">
                    <option selected>Choose...</option>
                    <option>...</option>
                  </select>
                </div>
                <div class="form-group col-sm-4">
                  <label for="inputVersion">Version</label>
                  <select id="inputVersion" class="form-control">
                    <option selected>Choose...</option>
                    <option>...</option>
                  </select>
                </div>
                <button type="submit" class="btn btn-primary">Go</button>
              </div>
            </form>
            <div id="txtHint"><div>
        </div>
    </body>
</html>

<script>

  $('#inputMake').change(function () {

    var id = $(this).find('option:selected').val();
    alert(id);
    console.log(id);
    // $.ajax({
    //     type: 'POST',
    //     url: '../include/continent.php',
    //     data: {
    //         'id': id
    //     },
    //     success: function (data) {
    //         // the next thing you want to do 
    //         var $country = $('#country');
    //         $country.empty();
    //         $('#city').empty();
    //         for (var i = 0; i < data.length; i++) {
    //             $country.append('<option id=' + data[i].sysid + ' value=' + data[i].name + '>' + data[i].name + '</option>');
    //         }

    //         //manually trigger a change event for the contry so that the change handler will get triggered
    //         $country.change();
    //     }
    // });
  });

</script>

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
        height:306px;
        margin-bottom: 15px;
        margin-top: 15px;
        border-style: solid;
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

