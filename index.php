<?php
require_once 'core/init.php';

// $user = DB::getInstance()->delete('users', ['u_id', '=', 4]);

//flashes a message only once e.g You are now registered
if (Session::exists('home')) {
    echo '<p>'. Session::flash('home') . '</p>';
} 

$user = new User();

if ($user->isLoggedIn()) {
?>
    <p>Hello <a href="#"><?php echo escape($user->data()->u_username); ?></a>!</p>

    <ul>
        <li><a href="logout.php">Log out</a></li>
    </ul>
<?php
    var_dump(Input::getAll());
    if(isset($_GET)) {
        echo "set";
        var_dump($_GET);
    }
    
} else {
    echo '<p>You need to <a href="login.php">log in</a> or <a href="register.php">register</a></p>';
}

?>


