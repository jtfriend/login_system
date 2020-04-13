
<?php
require_once 'core/init.php';

if(Input::exists()) {
    if(Token::check(Input::get('token'))) {
        $validate = new Validate();
        $validation = $validate->check($_POST, [
            'username' => [
                'required' => true,
                'min'   => 2,
                'max'   =>10,
                'unique'=>'users',
            ],
            'password' => [
                'required' => true,
                'min'   => 6,
            ],
            'password_again' => [
                'required' => true,
                'min'   => 6,
                'matches' => 'password',
            ],
            'name' => [
                'required' => true,
                'min'   => 2,
                'max'   =>20,
            ],
        ]);

        if($validation->passed()) {
            Session::flash('Success', 'You registered correctly');
            $user = new User();

            $salt = Hash::salt(32);
            try {
                $user->create([
                    'u_username'  => Input::get('username'),
                    'u_password'  => Hash::make(Input::get('password'), $salt),
                    'u_salt'      => $salt,
                    'u_name'      => Input::get('name'),
                    'u_joined'    => date('Y-m-d H:i:s'),
                    'u_group'     => 1,

                ]);

                Session::flash('login', 'You are now registered!');
                Redirect::to('login.php');
                // Redirect::to(404);

            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            foreach($validation->errors() as $error){
                echo $error;
                echo "<br>";
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
                            <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username'));?>" autocomplete="off">
                        </div>
                    </div>

                    <div class="form-group field row" >
                        <div class="field col-md-6" style="text-align:right" >
                            <label for="password">Choose a password</label>
                        </div>
                        <div class="field col-md-6" style="text-align:left" >
                            <input type="password" name="password" id="password">
                        </div>
                    </div>

                    <div class="form-group field row" >
                        <div class="field col-md-6" style="text-align:right" >
                            <label for="password_again">Re-enter your password</label>
                        </div>
                        <div class="field col-md-6" style="text-align:left" >
                            <input type="password" name="password_again" id="password_again">
                        </div>
                    </div>

                    <div class="form-group field row" >
                        <div class="field col-md-6" style="text-align:right" >
                            <label for="name">Choose a name</label>
                        </div>
                        <div class="field col-md-6" style="text-align:left" >
                            <input type="text" name="name" id="name" value="<?php echo escape(Input::get('name'));?>">
                        </div>
                    </div>

                    <div class="form-group field" >
                        <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                        <input style="background-color:#4542ff;" class="btn" type="submit" value="Register">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


</html>