<?php
require_once 'core/init.php';

if(Input::exists()) {
    // echo 'Input type : Yes';
    if(Token::check(Input::get('token'))) {
        // echo Token::check(Input::get('token'));
        $validate = new Validate();
        $validation = $validate->check($_POST, [
            'username'  => ['required'  => true],
            'password' => ['required'  => true]
        ]);
        if ($validation->passed()) {
            $user = new User();
            $login = $user->login(Input::get('username'), Input::get('password'));
            // if ($login) {
            //     Redirect::to('index.php');
            // } else {
            //     echo 'No user';
            // }
        } else {
            foreach ($validation->errors() as $error) {
                echo $error, '<br>';
            }
        }
    }

}

?>

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
    <input type="submit" value="Log in">
</form>
