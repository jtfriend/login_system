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

if (isset($_POST)) {
    foreach($_POST as $key => $data){
        $db->insert("data", [
            "d_field" => $key,
            "d_value" => $data,

        ]);
    }
}

if (isset($_GET)) {
    foreach($_GET as $key => $data){
        $db->insert("data", [
            "d_field" => $key,
            "d_value" => $data,

        ]);
    }
}

$allData = $db->getAllFromTable("data", "d_id");

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

<body>
    <canvas id="chartJSContainer" width="600" height="400"></canvas>
</body>
<script src="JS/Chart.bundle.min.js"></script>
<script>

    var options = {
        type: 'line',
        data: {
            labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
            datasets: [
                {
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                borderWidth: 1
                },
                    {
                        label: '# of Points',
                        data: [7, 11, 5, 8, 3, 7],
                        borderWidth: 1
                    }
                ]
        },
        options: {
            scales: {
                yAxes: [{
                ticks: {
                    reverse: false
                }
            }]
            }
        }
    }

    var ctx = document.getElementById('chartJSContainer').getContext('2d');
    new Chart(ctx, options);

</script>
