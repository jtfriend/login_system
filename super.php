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

if ($user->isLoggedIn() && $user->isSuper($user->data()->u_username)) {
  $db = new DB();
  $db->getAllFromTable('users', 'u_id');
  $table_array = $db->results();

?>
    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> 
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="vendor/twbs/bootstrap/dist/css/bootstrap-grid.css">
    <link rel="stylesheet" href="CSS/custom.css">
    <head>
      <script src="https://kit.fontawesome.com/11a33727f1.js" crossorigin="anonymous"></script>

    </head>
    <div style="background-color:#ffffff; height:100%;">
      <div class="container-fluid bg-dark">
        <div class="row justify-content-md-center bg-blue text-white" style="padding:20px;">
            <div style="text-align: center;" class="col-sm">Hello <a href="#"><?php echo escape($user->data()->u_username); ?></a>!</div>
            <div id="upper-mid-text" style="text-align: center; font-size: 1.3rem;" class="col-sm">Super User Area</div>
            <div style="text-align: center;" class="col-sm"><a href="logout.php">Log out</a></div>
        </div>
      </div>

      <div class="container" style="background-color:#e67300;">
        <div class="row" style="padding:10px;">
        <h3> Users </h3>
          <table class="table">
            <thead>
              <tr>
              <?php foreach ($table_array[0] as $key => $value) {
                if(!($key == 'u_password' || $key == 'u_salt')) {?>
                  <th scope="col"><?php echo($key); ?></th>
                <?php } ?>   
              <?php } ?>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($table_array as $value_array) {?>
                <?php foreach ($value_array as $key => $value) {
                  if ($key == 'u_id') {
                    $u_id = $value;
                  }
                  if(!($key == 'u_password' || $key == 'u_salt')) {?>
                    <td> <?php echo($value); ?></td>
                  <?php } ?>
                <?php } ?> 
                  <td>
                    <form action='ajax/delete_user.php?id=<?php echo($u_id); ?>' method="post">
                      <!-- <input type="submit" value=""><i  class="fas fa-trash"></i> -->
                      <button class="btn" type="submit"><i class="fa fa-trash"></i></button>
                    </form>
                  </td>
                <tr>
              <?php } ?>
            </tbody>
          </table>
          <div id="txtHint"><div>
        </div>
      </div>
</html>





    <?php
} else {
    Redirect::to('login.php');
    // echo '<p>You need to <a href="login.php">log in</a> or <a href="register.php">register</a></p>';
}


?>

<script>

  function deleteUser(id) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("txtHint").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "ajax/delete_user.php?id="+id, true);
    xmlhttp.send();
  }
</script>
