<?php
require_once '../core/init.php';

$user = new User();

if ($user->isLoggedIn()) {
} else {
    Redirect::to( '../login.php');
}

$string = file_get_contents("car_collection.json");
$json_data = json_decode($string, true);

//get size of makes list
foreach ($json_data as $carMake => $carModelList) {
  //put list of models inside each make 
  $carMakeList[] = $carModelList;
  $carMakeListNames[] = $carMake;
}
//choose a random number inside the max of the size
$randMakeNum = rand(0, sizeof($carMakeList)-1);

//add make to randCar variable
$randCar = strtolower($carMakeListNames[$randMakeNum]);

//put value into make list and look for models in that make
foreach ($carMakeList[$randMakeNum] as $carModel => $versionList) {
  $carModelList[] = $versionList;
  $carModelListNames[] = $carModel;
}

//choose a random number inside the max of the size
$randModelNum = rand(0, (sizeof($carMakeList[$randMakeNum])-1));

//add model to randCar variable
$randCar = $randCar . "-" . strtolower($carModelListNames[$randModelNum]);

//put value into models list and look for versions in that make
foreach ($carModelList[$randModelNum] as $carVersion => $data) {
  $carVersionList[] = $data;
  $carVersionListNames[] = $carVersion;
}

//choose a random number inside the max of the size
$randVersionNum = rand(0, sizeof($carVersionListNames)-1);

//add model to randCar variable
$randCar = $randCar . "-" . strtolower($carVersionListNames[$randVersionNum]);

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
        <div id="resultWindow" class="center" style="background-color:#8585ad;">
            <div id="resultValue"></div>
            <h5>Previous Attempts</h5>
            <table class="center table table-sm table-bordered">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Answer</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>Correct</td>
                </tr>
                <tr>
                  <th scope="row">2</th>
                  <td>Incorrect</td>
                </tr>
                <tr>
                  <th scope="row">3</th>
                  <td>Incorrect</td>
                </tr>
              </tbody>
            </table>
            <div>
              <a href="#" id="tryAgainButton" class="btn active" role="button" aria-pressed="true">Try Again</a>
              <button type="button" id="nextButton" class="btn btn-outline-primary">Primary</button>
              <a href="#" class="btn active" role="button" aria-pressed="true">Link</a>
              <a href="game.php" class="btn btn-info" role="button">Next</a>
            </div>
          </div>
        <div id="mainCont" class="container" style="background-color:gray;">
          
            <div class="row" style="font-size: 20; font-weight: 500; padding:10px;">
              <div class="container-fluid">
                <h3><a href="view.php">< Back</a> </h3>
              </div>
              <div class="container-fluid">
                <h1> Game </h1>
                <h2> What car is this? </h2>
              </div>
            </div>
            <div class="row" style="font-size: 20; font-weight: 500; padding:10px;">
              <div class="col-sm-12 item-box-details ">
                <img src="<?php echo "car_collection_images/" . $randCar . ".jpeg"; ?>" style="width:auto;height:300px;" />
              </div>
            </div>
            <form id="selectForm" action='../ajax/check_answer.php' method="post">
              <div class="form-row">
                <div class="form-group col-sm-4">
                  <label for="inputMake">Make</label>
                  <select id="inputMake" name="make" class="form-control">
                    <option selected>Select</option>
                    <?php foreach ($json_data as $carMake => $carModelList) { ?>
                      <option><?php echo $carMake ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group col-sm-4">
                  <label for="inputModel">Model</label>
                  <select id="inputModel" name="model" class="form-control">
                  </select>
                </div>
                <div class="form-group col-sm-4">
                  <label for="inputVersion">Version</label>
                  <select id="inputVersion" name="version" class="form-control">
                  </select>
                </div>
                <input hidden name="actual" value="<?php echo $randCar; ?>"></label>
                <button id="goButton" class="btn btn-primary">Go</button>
              </div>
            </form>
            
        </div>
    </body>
</html>

<script>

  // $('#selectForm').submit(function (e) {
  //   e.preventDefault();

  //   var form = $(this);
  //   var url = form.attr('action');

  //   $.ajax({
  //       type: 'POST',
  //       url: url,
  //       data: form.serialize(),
  //       success: function (data) {
  //         $('#txtHint').text(data);
  //       }
  //   });
  // }​);

  $('#tryAgainButton').click(function() {
    $('#resultWindow').css({
            zIndex: '-1'
    });
    $('#mainCont').css({
      filter: 'blur(0px)'
    });
  });

  $('#nextButton').click(function() {
    $.get("game.php", function( data ) {
    });
  });

  $('#selectForm').submit(function (e) {
    e.preventDefault();

    var form = $(this);
    var url = form.attr('action');

    $.ajax({
        type: 'POST',
        url: url,
        data: form.serialize(),
        success: function (data) {
          if(data == '1') {
            $('#resultValue').html('<h2>Correct</h2>');
            $('#tryAgainButton').hide();
          } else {
            $('#resultValue').html('<h2>Incorrect</h2>');
            $('#tryAgainButton').show();
            
          }
          $('#mainCont').css({
            filter: 'blur(2px)'
          });
          
          $('#resultWindow').css({
              zIndex: '1'
            });
          
        }
    });

    // $.get(url,form.serialize(), function(data){
    //   $('#txtHint').text(data);
    // });

    // $.get({
    //     type: 'POST',
    //     url: url,
    //     data: form.serialize(),
    //     success: function (data) {
    //       $('#txtHint').text(data);
    //     }
    // });
    });

  $('#inputMake').change(function () {

    var make = $(this).find('option:selected').val();
    $.ajax({
        type: 'POST',
        url: '../ajax/getCarData.php',
        data: {
            'make': make
        },
        success: function (data) {
            var $model = $('#inputModel');
            $model.empty();
            $('#inputModel').empty();
            var models = jQuery.parseJSON(data);
            for (var i = 0; i < models.length; i++) {
                $model.append('<option id=' + models[i] + ' value=' + models[i] + '>' + models[i] + '</option>');
            }

            //manually trigger a change event for the contry so that the change handler will get triggered
            $model.change();
        }
    });
  });

  $('#inputModel').change(function () {
    var model = $(this).find('option:selected').val();
    $.ajax({
        type: 'POST',
        url: '../ajax/getCarData.php',
        data: {
            'model': model
        },
        success: function (data) {
            // the next thing you want to do 
            var $version = $('#inputVersion');
            $version.empty();
            $('#inputVersion').empty();
            var versions = jQuery.parseJSON(data);
            for (var i = 0; i < versions.length; i++) {
                $version.append('<option id=' + versions[i] + ' value=' + versions[i] + '>' + versions[i] + '</option>');
            }
            // Object.keys(versions).forEach(function(key) {
            //   $version.append('<option id=' + key + ' value=' + key + '>' + key + '</option>');
            // });

            //manually trigger a change event for the contry so that the change handler will get triggered
            $version.change();
        }
    });
  });

  $(window).on('load', function () {
    set_splashscren();
    $('#tryAgainButton').hide();
  });

  $( window ).resize(function() {
    set_splashscren();
  });

  function set_splashscren() {
    main_width = $('#mainCont').width();
    main_height = $('#mainCont').height();
    splash_width = main_width * 0.5;
    splash_height = main_height * 0.5;
    $('#resultWindow').width(splash_width);
    $('#resultWindow').height(splash_height);
    $('#resultWindow').css({
      top: '50%',
      left: '50%',
      marginLeft: '-' + splash_width * 0.5 + 'px',
      marginTop: '-' + splash_height * 0.5 + 'px',
    });
  }

</script>

<style>

#resultWindow {
  height: 300px;
  position: absolute;
  z-index: -1;
}

</style>

