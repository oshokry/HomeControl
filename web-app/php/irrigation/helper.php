<?php
  function isGoodDay($day) {
    $days = array("SAT", "SUN", "MON", "TUE", "WED", "THU", "FRI");
    return in_array($day, $days);
  }
  
  function isGoodSol($sol) {
    $sols = array("S1", "S2", "S3", "S4", "S5", "S6");
    return in_array($sol, $sols);
  }

  function getMarker($dayTxt, $solText) {
    require_once '../lib/util.php';
    $DB = getDB('Irrigation');
    
    $sqlStatement = "SELECT * from TimingSchedule where dayOfWeek = \"";
    $sqlStatement .= $dayTxt;
    $sqlStatement .= "\" and solenoidNumber = \"";
    $sqlStatement .= $solText;
    $sqlStatement .= "\" and enabled = \"1\"";
    $marker = 0;
    $result = $DB::query($sqlStatement);
    foreach ($result as $row) {
  	  $marker += $row['lengthSeconds'];
    }
    
    return $marker;
  }
?>
