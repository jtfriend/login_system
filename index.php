<?php
require_once 'core/init.php';

// if (Session::exists('jtf3')) {
//     echo '<p>'. Session::flash('home') . '</p>';
//     echo "session exists";
// } else {
//     echo "no session exists";
// }

$user = new User();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//#e67300

if ($user->isLoggedIn()) {
?>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap-grid.css">
    <link rel="stylesheet" href="CSS/my_css.css">
    <div style="background-color:#ffffff; height:100%;">
        <div class="container-fluid bg-dark">
            <div class="row justify-content-md-center bg-blue text-white" style="padding:20px;">
                <div style="text-align: center;" class="col-sm">Hello <a href="#"><?php echo escape($user->data()->u_username); ?></a>!</div>
                <div id="upper-mid-text" style="text-align: center; font-size: 1.3rem;" class="col-sm">Content Selection</div>
                <?php if ($user->isSuper($user->data()->u_username)) { ?>
                <div id="upper-mid-text" style="text-align: center; font-size: 1.3rem;" class="col-sm"><a href="super.php">Super User Content</a></div>
                <?php } ?>
                <div style="text-align: center;" class="col-sm"><a href="logout.php">Log out</a></div>
            </div>
        </div>
        <div class="container" style="background-color:#e67300;">
            <div class="row" style="padding:10px;">
                <div class="col-sm-3" style="text-align:center; height:200px; margin-bottom: 15px; margin-top: 15px;">
                    <form style="" action="elf_rescue/index.php" method="post">
                        <input type="hidden" name="username" value="<?php echo $user->data()->u_username; ?>">
                        <div class="box-1 h-100 justify-content-center" style="display:flex;flex-direction: column;">
                            <input class="boring_button" type="submit" value="Play Elf Rescue">
                        </div>
                    </form>
                </div>
                <div class="col-sm-3" style="text-align:center; height:200px; margin-bottom: 15px; margin-top: 15px;">
                    <form style="" action="learn_swansea/index.php" method="post">
                        <input type="hidden" name="username" value="<?php echo $user->data()->u_username; ?>">
                        <div class="box-1 h-100 justify-content-center" style="display:flex;flex-direction: column;">
                            <input class="boring_button" type="submit" value="Learn Swansea">
                        </div>
                    </form>
                </div>
                <div class="col-sm-3" style="text-align:center; height:200px; margin-bottom: 15px; margin-top: 15px;">
                    <form style="" action="location_finder/index.php" method="post">
                        <input type="hidden" name="username" value="<?php echo $user->data()->u_username; ?>">
                        <div class="box-1 h-100 justify-content-center" style="display:flex;flex-direction: column;">
                            <input class="boring_button" type="submit" value="Location Finder">
                        </div>
                    </form>
                </div>
                <div class="col-sm-3" style="text-align:center; height:200px; margin-bottom: 15px; margin-top: 15px;">
                    <form style="" action="lego_collection/index.php" method="post">
                        <input type="hidden" name="username" value="<?php echo $user->data()->u_username; ?>">
                        <div class="box-1 h-100 justify-content-center" style="display:flex;flex-direction: column;">
                            <input class="boring_button" type="submit" value="Lego Collection">
                        </div>
                    </form>
                </div>
                <div class="col-sm-3" style="text-align:center; height:200px; margin-bottom: 15px; margin-top: 15px;">
                    <form style="" action="cars/view.php" method="post">
                        <input type="hidden" name="username" value="<?php echo $user->data()->u_username; ?>">
                        <div class="box-1 h-100 justify-content-center" style="display:flex;flex-direction: column;">
                            <input class="boring_button" type="submit" value="Cars">
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php
} else {
    Redirect::to('login.php?q=0');
    // echo '<p>You need to <a href="login.php">log in</a> or <a href="register.php">register</a></p>';
}


?>


