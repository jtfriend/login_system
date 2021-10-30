
<?php
require_once '../core/init.php';

$user = new User();

if ($user->isLoggedIn()) {
} else {
    Redirect::to( '../login.php');
}

if(Input::exists()) {


  
  $validate = new Validate();
  $validation = $validate->check($_POST, [
    'make' => [
        'required' => true,
        'min'   => 2,
        'max'   =>20,
    ],
    'model' => [
      'required' => true,
      'min'   => 2,
      'max'   =>20,
    ],
    'version' => [
      'required' => true,
      'min'   => 2,
      'max'   =>20,
    ],
    'production' => [
        'required' => false,
        'min'   => 2,
        'max'   =>20,
    ]
  ]);

  if($validation->passed()) {
    $fileNameToBe = Input::get('make') . '-' . Input::get('model') . '-' . Input::get('version');
    $uploadOk = saveUploadedFile($fileNameToBe);
    if($uploadOk) {
      $car = new Car();
      try {
          $car->create([
              'c_make'  => Input::get('make'),
              'c_model'  => Input::get('model'),
              'c_version'      => Input::get('version'),
              'c_production_years'      => Input::get('production'),
              'c_legit' => 1,
              'c_deleted' => 0
          ]);
          echo("Added Car");

      } catch (Exception $e) {
          die($e->getMessage());
      }
    }
  } else {
      foreach($validation->errors() as $error){
          echo $error;
          echo "<br>";
      }
  }
 
}


function saveUploadedFile($fileNameToBe) {
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }
  
  //check if file selected
  if (empty($_FILES['fileToUpload']['name'])) {
    echo "Please select an image";
    $uploadOk = 0;
  }  elseif (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  } elseif ($_FILES["fileToUpload"]["size"] > 1000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  } elseif($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    // echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {

    $temp = explode(".", $_FILES["fileToUpload"]["name"]);
    $newImageName = $fileNameToBe . '.' . "jpeg";
    
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], "uploads/" . $newImageName)) {
      echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }

  return $uploadOk;
}
?>
<html>
  <meta charset="utf-8"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
  <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.css">
  <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap-grid.css">
  <script src="../node_modules/jquery/dist/jquery.js"></script>
  <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.js"></script>
  <link rel="stylesheet" href="../CSS/my_css.css">
  <div style="background-color:#595959;">
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
            <h3><a href="view.php">< Back</a> </h3>
          </div>
          <div class="container-fluid">
            <h1> Add Car </h1>
          </div>
        </div>
        <div class="row justify-content-md-center">
          <div class="col-md-6 no-gutters text-center">
              <form style="margin-top:15px;" enctype="multipart/form-data" action="" method="post">
                  <div class="form-group field row" >
                      <div class="field col-md-6 field-form" style="text-align:right" >
                          <label for="make">Make</label>
                      </div>
                      <div class="field col-md-6 field-form" style="text-align:left" >
                          <input type="text" name="make" id="make" autocomplete="off">
                      </div>
                  </div>

                  <div class="form-group field row" >
                      <div class="field col-md-6 field-form" style="text-align:right" >
                          <label for="model">Model</label>
                      </div>
                      <div class="field col-md-6 field-form" style="text-align:left" >
                          <input type="text" name="model" id="model" autocomplete="off">
                      </div>
                  </div>

                  <div class="form-group field row" >
                      <div class="field col-md-6 field-form" style="text-align:right" >
                          <label for="version">Version</label>
                      </div>
                      <div class="field col-md-6 field-form" style="text-align:left" >
                          <input type="text" name="version" id="version" autocomplete="off">
                      </div>
                  </div>

                  <div class="form-group field row" >
                      <div class="field col-md-6 field-form" style="text-align:right" >
                          <label for="make">Production</label>
                      </div>
                      <div class="field col-md-6 field-form" style="text-align:left" >
                          <input type="text" name="production" id="production" autocomplete="off">
                      </div>
                  </div>
                  <div class="form-group field row" >
                    <div class="field col-md-12" style="text-align:center" >
                      <input type="file" name="fileToUpload" id="fileToUpload">
                    </div>
                  </div>

                  
                  <div class="form-group field" >
                      <input style="background-color:#4542ff;" class="btn" type="submit" value="Add">
                  </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</html>

<style>
  @media only screen and (max-width: 768px){
    .field-form {
      text-align: center !important;
    }
  }
</style>