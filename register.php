
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

                Session::flash('home', 'You are now registered!');
                Redirect::to('index.php');
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
<form action"" method="post">
    <div class="field">
        <label for="username">Username</label>
        <input type="text" name="username" id="username" value="<?php echo escape(Input::get('username'));?>" autocomplete="off">
    </div>
    <div class="field">
        <label for="password">Choose a password</label>
        <input type="password" name="password" id="password">
    </div>
    <div class="field">
        <label for="password_again">Enter your password again</label>
        <input type="password" name="password_again" id="password_again">
    </div>
    <div class="field">
        <label for="name">Choose a name</label>
        <input type="text" name="name" id="name" value="<?php echo escape(Input::get('name'));?>">
    </div>

    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
    <input type="submit" value="Register">
</form>
