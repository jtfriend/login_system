<?php
require_once '../core/init.php';


// if (Session::exists('home')) {
//     echo '<p>'. Session::flash('home') . '</p>';
// }

$user = new User();

if ($user->isLoggedIn()) {
} else {
    Redirect::to( '../login.php');
}

?>

<html id="system-background">
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap-grid.css">
    <link rel="stylesheet" href="../CSS/my_css.css">
    <body style="margin:10px; background-color :#ff6600;">
        <div id="heading-box" class="center">
            <div class="text-center" style="color:white;">ELF RESCUE</div>
        </div>

        <div id="main-box" class="center" style="height:174px; margin-top:10px; background-color: blue">
            <div class="home_button" >
                <a href="../login.php">Home</a>
            </div>
            <form action="run.php" method="POST">
                <div  class="text-center" style="padding-top: 10px; color:white">Name</div>
                <div class="center text-center" style="padding-top: 10px;">
                    <?php if (isset($_POST['username'])) { ?>
                        <input style="width:50%;" class="text-center" type="text" value ="<?php echo $_POST['username'] ?>" name="username" readonly>
                    <?php } else { ?>
                        <input style="width:50%;" class="text-center" type="text" name="username" required>
                    <?php } ?>
                    
                </div>
                <div class="center text-center" style="padding-top: 10px;">
                    <input onmouseover="" style="cursor: pointer;" type="submit" class="button" value="Play">
                </div>
            </form> 
        </div>
        <div class="container"style="width:50%; background-color: #4b0082;">
            <div class="row justify-content-md-center bg-blue text-white">
                <div style="text-align: center; padding:13px;border: solid 2px;" class="col-sm">
                    <div style="margin-bottom:10px;">Leaderboard</div>
                    <table style="width: 100%; color:white;"> 
                        <?php
                            $db = new DB();
                            $allUsersTopScoreData = $db->rawMySQL('SELECT u_username, MAX(s_value) as s_value_max FROM `users` JOIN `scores` WHERE u_id = s_uid GROUP BY u_id DESC');
                        ?>
                        <tr style="text-align:center;">
                            <th style="width: 50%;">username</th>
                            <th style="width: 50%;">score</th>
                        </tr>
                        <?php foreach ($allUsersTopScoreData->_results as $userData) { ?>
                        <tr style="text-align:center;">
                            <td style="width: 50%;"><?php echo $userData->u_username; ?></td> 
                            <td style="width: 50%;"><?php echo $userData->s_value_max; ?></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
                <div style="text-align: center; padding:13px;border: solid 2px;" class="col-sm">
                    <div style="margin-bottom:10px;">Your Scores</div>
                    <table style="width: 100%; color:white;"> 
                        <?php
                            $allScoreData = $db->get("scores", ["s_uid", "=", $user->data()->u_id]);
                            // var_dump($allScoreData);
                        ?>
                        <tr style="text-align:center;">
                            <th style="width: 50%;">timestamp</th>
                            <th style="width: 50%;">score</th>
                        </tr>
                        <?php foreach ($allScoreData->_results as $score) { ?>
                        <tr style="text-align:center;">
                            <td style="width: 50%;"><?php echo substr($score->s_timestamp, 0, -3); ?></td> 
                            <td style="width: 50%;"><?php echo $score->s_value; ?></td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>

        <div id="data-box" class="center" style="">
            
        </div>
    </body>
</html>

<style>
    #system-background {
        background-color:#ff6600;
    }

    .center {
        margin: auto;
        width: 50%;
    }

    #heading-box{
        background-color:#ff6600;
        border: 3px solid blue;
        padding: 10px;
    }

    #main-box {
        padding: 13px;
    }
    
    .text-center {
        text-align:center;
        font-family: sans-serif;
    }
    .button {
        background-color: #ff6600; /* Green */
        border: none;
        color: white;
        padding: 15px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
    }

    .home_button {
        position:fixed;
        background-color: #ff6600; /* Green */
        border: none;
        color: white;
        padding: 8px 16px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
    }

    a {
        color:white;
    }

    a:hover {
        color: white;
        text-decoration:inherit;
    }
</style>

