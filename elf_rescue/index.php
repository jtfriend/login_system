<?php
require_once '../core/init.php';


$user = new User();



if ($user->isLoggedIn()) {
    if (isset($_GET['username'])) {
    } else {
        Redirect::to( '../index.php');
    }
} else {
    Redirect::to( '../login.php');
}

?>

<html id="system-background">
    <body>
        <div id="heading-box" class="center">
            <div class="text-center" style="color:white;">ELF RESCUE</div>
        </div>
        <div id="main-box" class="center" style="height:140px; margin-top:10px; background-color: blue">
            <form action="run.php" method="GET">
                <div class="text-center">Name</div><br>
                <div class="center text-center">
                    <?php if (isset($_GET['username'])) { ?>
                        <input style="width:50%;" class="text-center" type="text" value ="<?php echo $_GET['username'] ?>" name="name" readonly>
                    <?php } else { ?>
                        <input style="width:50%;" class="text-center" type="text" name="name" required>
                    <?php } ?>
                    
                </div>
                <br>
                <div class="center text-center" >
                    <input onmouseover="" style="cursor: pointer;" type="submit" class="button" value="Play">
                </div>
            </form> 
        </div>
        <div>
            <table style="width:100%"> 
                <?php
                    
                    $db = new DB();
                    $allData = $db->getAllFromTable("users", "u_id");
                ?>
                <tr style="text-align:center;">
                    <th>Existing Users</th> 
                </tr>
                <?php foreach ($allData->_results as $user) { ?>
                <tr style="text-align:center;">
                    <td><?php echo $user->u_name; ?></td> 
                </tr>
                <?php } ?>
            </table>
        </div>
        <table style="width:100%">
            
        </table>
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
</style>

