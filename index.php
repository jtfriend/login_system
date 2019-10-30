<?php
require_once 'core/init.php';

if (Session::exists('home')) {
    echo '<p>'. Session::flash('home') . '</p>';
}

$user = new User();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($user->isLoggedIn()) {
?>
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap-grid.css">
    <div style="background-color:#595959;">
        <div class="container-fluid bg-dark" style="height:10%;">
            <div class="row justify-content-md-center bg-blue text-white">
                <div class="mx-auto">Hello <a href="#"><?php echo escape($user->data()->u_username); ?></a>!</div>
                <ul>
                        <li><a href="logout.php">Log out</a></li>
                </ul>
            </div>
        </div>
        <div class="container bg-dark" style="height:80%;">
            <div class="row justify-content-md-center bg-dark"></div>
            <div class="row justify-content-md-center bg-dark">
                <div class="d-flex p-2 bd-highlight">I'm a flexbox container!</div>
                    
        
                    
                </div>
            </div>
        <div class="container-fluid bg-dark" style="height:10%;">
            <div class="row justify-content-md-center bg-dark">Footer</div>
        </div>
    </div>
<?php
} else {
    Redirect::to('login.php');
    // echo '<p>You need to <a href="login.php">log in</a> or <a href="register.php">register</a></p>';
}


?>
