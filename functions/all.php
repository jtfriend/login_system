<?php

function escape($string) {
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

//get unique list of cars
function getUniqueArray ($carArray, $carField) {
    $carFieldArray = [];
  
    foreach ($carArray as $car) { 
      if (!in_array($car->$carField, $carFieldArray)) {
        $carFieldArray[] = $car->$carField;
      }
    }
    return $carFieldArray;
  }

?>
