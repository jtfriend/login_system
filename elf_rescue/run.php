<html>
    <body>
        <div id="score-bar">
        </div>

    </body>
</html>


<script src="node_modules/jquery/dist/jquery.js"></script>
<script src="touchscreen.js"></script>
<script src="index.js"></script>

<?php

require_once '../core/init.php';

$user = new User();

if ($user->isLoggedIn()) {
    if (isset($_GET['username'])) {
    } else {
        Redirect::to('index.php');
    }

    Redirect::to( 'index.php?username=' + $_GET['username']);
} else {
    Redirect::to( '../login.php');
}

?>
<script>

    postData = "<?php echo $_GET['username']; ?>"
    gameInfo = main();

</script>