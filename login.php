<?php
require_once 'core/init.php';

if(Input::exists()) {
    echo 'Input type : Yes';
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
        <div class="row justify-content-md-center">
            <div class="col-xl-auto no-gutters">
                <form action="" method="post">
                    <div class="field">
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" autocomplete="off">
                    </div>

                    <div class="field">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" autocomplete="off">
                    </div>

                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    <input class="btn" type="submit" value="Log in">
                </form>
            </div>
        </div>
    </div>
</div>


</html>
