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
    
} else {
    echo '<p>You need to <a href="login.php">log in</a> or <a href="register.php">register</a></p>';
}

$db = new DB();
    
// $db->insert("data", [
//     "d_field" => "test",
//     "d_value" => 5
// ]);

if (isset($_GET)) {
    foreach($_GET as $key => $data){
        $db->insert("data", [
            "d_field" => $key,
            "d_value" => $data,

        ]);
    }
}

$allData = $db->getAllFromTable("data", "d_timestamp");

echo "<table>
        <tr>
            <th>ID</th>
            <th>Field</th> 
            <th>Value</th>
            <th>Timestamp</th>
        </tr>";
    foreach($allData->_results as $count => $row) {
        echo "
        <tr>
            <th> ". $row->d_id . "</th>
            <th> ". $row->d_field . "</th>
            <th> ". $row->d_value . "</th>
            <th> ". $row->d_timestamp . "</th>
        </tr>";
    }
echo "</table>";





?>


