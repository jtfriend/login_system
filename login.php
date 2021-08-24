<?php
require_once 'core/init.php';

$user = new User();

$q = isset($_REQUEST["q"]) ? $_REQUEST["q"]: false;

if ($user->isLoggedIn()) {
    if($q == "1") {
        Redirect::to('index.php');
    } else {
        Redirect::to('index.php?q=0');
    }
    
} else {
    if(Input::exists()) {
        if(Token::check(Input::get('token'))) {
            $validate = new Validate();
            $validation = $validate->check($_POST, [
                'username'  => ['required'  => true],
                'password' => ['required'  => true]
            ]);
            foreach ($validation->errors() as $error) {
                echo $error, '<br>';
            }
            if ($validation->passed()) {
                $user = new User();
                $remember = (Input::get('remember') === '1') ? true : false;
                $login = $user->login(Input::get('username'), Input::get('password'), $remember);
                $typeOfUser = "loyal";
                if ($login) {
                    Session::flash(Input::get('username'), $typeOfUser);
                    Redirect::to('index.php');
                }
            } else {
                foreach ($validation->errors() as $error) {
                    echo $error, '<br>';
                }
            }
        }

    }
}

    ?>
    <html >
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    <body onload="clearInputBoxes()">
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap-grid.css">
    <div style="background-color:#595959;">
        <div class="container-fluid bg-dark">
                <div class="row justify-content-md-center bg-blue text-white" style="padding:20px;">
                    <div class="mx-auto">JTF Pi Server</div>
                </div>
            </div>
        <div class="container" style="background-color:#e67300;">
            <div class="row justify-content-center">
                <div class="col-md-6 col-sm-6 col-6 text-center">
                    <form style="margin-top:15px;" action="" method="post">
                        <div class="row justify-content-md-center input-group-lg mb-3">
                            <label for="inputEmail3" style="text-align:right;" class="col-md-6 col-sm-6 col-6 col-form-label">Username</label>
                            <div class="col-md-6 col-sm-6 col-6" >
                            <input type="text" class="form-control" value="" name="username" id="username" autocomplete="off" required>
                            </div>
                        </div>
                        <div class="row justify-content-md-center input-group-lg mb-3">
                            <label for="inputPassword3" style="text-align:right;" class="col-md-6 col-sm-6 col-6 col-form-label">Password</label>
                            <div class="col-md-6 col-sm-6 col-6">
                            <input type="password" class="form-control" value="" name="password" id="password" required>
                            </div>
                        </div>
                        <div class="form-group field row" >
                            <input type="hidden" name="remember" id="remember" value="1">
                            <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                            <div id="submitbut" style="text-align:right;" class="field col-md-6 col-sm-6 col-6" >
                                <input style="background-color:#4542ff;" class="btn" type="submit" value="Log in">
                            </div>
                            <div class="field col-md-6 col-sm-6 col-6" style="text-align:left" >
                                <a href="register.php" style="background-color:#4542ff;" class="btn">Register</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </html>


    <script>
function clearInputBoxes() {
  document.getElementById("username").value= "";
}
</script>

<style>

@media (min-width: 576px) { 

}


</style>

