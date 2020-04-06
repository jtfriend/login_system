<?php
require_once 'core/init.php';

if(Input::exists()) {
    echo 'Input type : Yes\n';
    if(Token::check(Input::get('token'))) {
        echo Token::check(Input::get('token'));
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
            $login = $user->login(Input::get('username'), Input::get('password'));
            var_dump($user->data());
            if ($login) {
                Redirect::to('index.php');
                echo "success!";

            }
        } else {
            foreach ($validation->errors() as $error) {
                echo $error, '<br>';
            }
        }
    }

}

?>
<html>
<link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.css">
<link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap-grid.css">
<div style="background-color:#595959;">
    <div class="container-fluid bg-dark">
            <div class="row justify-content-md-center bg-blue text-white" style="padding:20px;">
                <div class="mx-auto">Catch in the Dark</div>
            </div>
        </div>
    <div class="container-fluid" style="background-color:#e67300;">
        <div class="row justify-content-md-center">
            <div class="col-md-6 no-gutters text-center">
                <form style="margin-top:15px;" action="" method="post">
                    <div class="form-group field row" >
                        <div class="field col-md-6" style="text-align:right" >
                            <label for="username">Username</label>
                        </div>
                        <div class="field col-md-6" style="text-align:left" >
                            <input type="text" name="username" id="username" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group field row" >
                        <div class="field col-md-6" style="text-align:right" >
                            <label for="password">Password</label>
                        </div>
                        <div class="field col-md-6" style="text-align:left" >
                            <input type="password" name="password" id="password" autocomplete="off">
                        </div>
                    </div>  

                    <div class="form-group field row" >
                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                        <div class="field col-md-6" style="text-align:right" >
                            <input style="background-color:#4542ff;" class="btn" type="submit" value="Log in">
                        </div>
                        <div class="field col-md-6" style="text-align:left" >
                            <a href="register.php" style="background-color:#4542ff;" class="btn">Register</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


</html>
