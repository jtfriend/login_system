<?php
require_once '../core/init.php';


$user = new User();
// if (!empty($listOfLocations)) {
//     foreach ($listOfLocations as $location) {
//         if(!($x > $location['xLower']  && $x < $location['xHigher'] && $y > $location['yLower']  && $y < $location['yHigher'])) {
//             $listOfLocations[] = [
//                 'xLower' => $x-5,
//                 'xHigher' => $x+20,
//                 'yLower' => $y-5,
//                 'yHigher' => $y+5
//             ];
//         } 
//     }
// } else {
//     $listOfLocations[] = [
//         'xLower' => $x-5,
//         'xHigher' => $x+20,
//         'yLower' => $y-5,
//         'yHigher' => $y+5
//     ];
// }


if ($user->isLoggedIn()) {
    if (isset($_POST['username'])) {
    } else {
        Redirect::to( '../index.php');
    }
} else {
    Redirect::to( '../login.php');
}

$im = ImageCreateFromPng("swansea_area12.png");
$xCoords =[];
$yCoords =[];
$listofLocations = [];
$previousX = 10000;
$previousY = 10000;

// for ($x = 0; $x < (imagesx($im)); $x++) {
//     for ($y = 0; $y < (imagesy($im)); $y++) {
//         $rgb = ImageColorAt($im, $x, $y);
//         $r = ($rgb >> 16) & 0xFF;
//         $g = ($rgb >> 8) & 0xFF;
//         $b = $rgb & 0xFF;
//         //if the colour grey or close to find words to hide or locate
//         if ($r > 90 && $r < 120 && $g > 90 && $g < 120 && $b > 90 && $b < 120) {
//             if ($x > $previousX && $x < ($previousX+15) && $y > $previousY && $y < ($previousY+15)) {
//             } else {
//                 $coords[] = [
//                     'x' => $x,
//                     'y' => $y
//                 ];
//                 $previousX = $x;
//                 $previousY = $y;
//             }
//         }
//     }
// }

// make list of words 
// foreach ($coords as $index => $coord) {
//     echo $index;
//     if (empty($listofLocations)) {
//         $listofLocations[] = [
//             'x' => $coord['x'],
//             'y' => $coord['y']
//         ];
//     } else {
//         foreach($listofLocations as $location) {
//             if ($coord['x'] > $location['x'] && $coord['x'] < ($location['x']+15)) {
//             } else {
//                 $listofLocations[] = [
//                     'x' => $coord['x'],
//                     'y' => $coord['y']
//                 ];
                
//             }
//         }
//     }
    
// }

// var_dump($coords);
// var_dump($listofLocations);


?>

<html id="system-background">
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap-grid.css">
    <link rel="stylesheet" href="../CSS/my_css.css">
    <script src="../node_modules/jquery/dist/jquery.js"></script>
  <script src="../vendor/twbs/bootstrap/dist/js/bootstrap.bundle.js"></script>
    <body>
        <div class="container-fluid">
            <div id="d1"></div>
            <div id="d2" style="height:20px"></div>
            <div class="row">
                <?php 
                for ($y = 0; $y < (imagesy($im)); $y++) {
                    for ($x = 0; $x < (imagesx($im));$x = $x+5) {
                        $rgb = ImageColorAt($im, $x, $y);
                        $r = ($rgb >> 16) & 0xFF;
                        $g = ($rgb >> 8) & 0xFF;
                        $b = $rgb & 0xFF;
                        if ($r > 90 && $r < 120 && $g > 90 && $g < 120 && $b > 90 && $b < 120) {
                            if (($x > $previousX && $x < ($previousX+50)) || ($y > $previousY && $y < ($previousY))) {
                                // echo "close";
                                // echo $x . ">" . $previousX . "&" . $x . "<" . ($previousX+15);
                            } else {
                                // echo "far";
                                // echo $x . ">" . $previousX . "&" . $x . "<" . ($previousX+15);
                                $coords[] = [
                                    'x' => $x,
                                    'y' => $y
                                ];
                                $previousX = $x;
                                $previousY = $y;
                                ?>
                                <!-- <div class="blocks" style="height:15px !important; width:15px  !important; top:<?php echo $y-5; ?>; left:<?php echo $x-5; ?>px;position: absolute; background-color:<?php echo "rgb(" . $r . "," . $g . "," . $b . ")"; ?>"></div> -->
                                <?php
                            }
                            
                        }
                    }
                } ?>
            </div>
        </div>
    </body>
    <?php //var_dump($xCoords);?>
</html>

<script>
    $( ".blocks" ).hover(function() {
        $( this ).fadeOut( 100 );
        $( this ).fadeIn( 500 );
    });

    $(document).ready(function() {
        $("#system-background").on("click", function(event) {
            var x = event.pageX;
            var y = event.pageY;
            var obj = {
                xCoord:x,
                yCoord:y
            };
            $('#d1').html("X Coordinate: " + x + ", Y Coordinate: " + y )
            $.ajax({
                type: 'POST',
                url: 'getColourFromPixel',
                data: {
                    json: JSON.stringify(obj)
                },
                success: function (data) {
                    $('#d2').css('background-color', data);
                }
            });
        });
    });
</script>

<style>
    body{
        background-image: url("swansea_area12");
        background-repeat: no-repeat, repeat;
        background-color: #cccccc;
    }

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

