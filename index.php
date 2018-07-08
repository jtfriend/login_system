<?php
require_once 'core/init.php';

// $user = DB::getInstance()->delete('users', ['u_id', '=', 4]);

if (Session::exists('home')) {
    echo '<p>'. Session::flash('home') . '</p>';
}
// if(!$user->count()) {
//     echo "No user";
// } else {
//     echo "Ok!";
//     echo $user->first()->u_username;
// }

$user = new User();
if ($user->isLoggedIn()) {
?>
    <p>Hello <a href="#"><?php echo escape($user->data()->u_username); ?></a>!</p>

    <ul>
        <li><a href="logout.php">Log out</a></li>
    </ul>
<?php
} else {
    echo '<p>You need to <a href="login.php">log in</a> or <a href="register.php">register</a></p>';
}

?>
