<?php

  function confirmLogin() {
    session_start();
    if(!isset($_SESSION['loggedin'])){
      header('Location: ../index.php');
    }
  }

  function loadSensorData($query) {
    require_once '../lib/util.php';
    $DB = getDB('Irrigation');
     
  //  DB::debugMode();
    $result = $DB::query($query);

//    echo 'console.log("' . $totalRows . '");';
    $totalRows = sizeof($result);
    echo "      data.addRows(" . $totalRows . ");\n";
	  $i = 0;

    $maxTemp = -100;
    $minTemp = 100;
    $maxHum = 0;
    $minHum = 100;
    foreach ($result as $row) {
      $t = $row["temperature"];
      $h = $row["humidity"];
      if($maxTemp < $t) {
        $maxTemp = $t;
      }  
      if($minTemp > $t) {
        $minTemp = $t;
      }
      if($maxHum < $h) {
        $maxHum = $h;
      }
      if($minHum > $h) {
        $minHum = $h;
      }
             
  	  echo "      data.setValue($i, 0, '" . $row["timestamp"] . "');";
  	  echo " data.setValue($i, 1,  " . $t . ");";
  	  echo " data.setValue($i, 2,  " . $h . ");\n";

    	$i++; 
    }

    $retVal['temp'] = round($result[$totalRows - 1]["temperature"], 1);
    $retVal['hum'] = round($result[$totalRows - 1]["humidity"]);

    $retVal['maxTemp'] = round($maxTemp, 1);
    $retVal['minTemp'] = round($minTemp, 1);
    $retVal['maxHum'] = round($maxHum);
    $retVal['minHum'] = round($minHum);
    
    $DB::disconnect();
    return $retVal;
  }
  
  function printTodayTH($values) {
    echo "Temperature now is " . $values['temp'] . "&#176;, ";
    echo "Humidity now is " . $values['hum'] . "%<br />";
  }

  function printMinMax($values) {
    echo "Max Temperature is " . $values['maxTemp'] . "&#176;, ";
    echo "Min Temperature is" . $values['minTemp'] . "&#176;<br />";
    echo "Max Humidity is " . $values['maxHum'] . "%, ";
    echo "Min Humidity is " . $values['minHum'] . "%";
  }
?>
