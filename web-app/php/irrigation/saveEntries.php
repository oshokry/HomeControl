<?php
session_start();
if(isset($_SESSION['loggedin'])){
  $dayTxt = $_SESSION['dayTxt'];
  $solText = $_SESSION['solText'];
  
  require_once 'helper.php';
  if(isGoodDay($dayTxt) && isGoodSol($solText)) {
    $newEntriesList = stripcslashes($_POST['newEntriesList']);
    $newEntriesList = json_decode($newEntriesList,TRUE);
    saveEntries($newEntriesList, $dayTxt, $solText);
  }
}
// do nothing if not logged in

  function saveEntries($entries, $dayTxt, $solText) {
    require_once '../lib/util.php';
    $DB = getDB('Irrigation');
    
    $sqlStatement = "DELETE from TimingSchedule WHERE dayOfWeek = \"";
    $sqlStatement .= $dayTxt;
    $sqlStatement .= "\" and solenoidNumber = \"";
    $sqlStatement .= $solText;
    $sqlStatement .= "\"";
    $DB::query($sqlStatement);
    
    foreach($entries as $entry) {
      $startTime = $entry['startTime'];
      $lengthSeconds = $entry['lengthSeconds'];
      $enabled = $entry['enabled'];
      $oneOff = $entry['oneOff'];
      $DB::insert('TimingSchedule', [
        'dayOfWeek' => $dayTxt,
        'solenoidNumber' => $solText,
        'startTime' => $startTime,
        'lengthSeconds' => $lengthSeconds,
        'enabled' => $enabled,
        'oneOff' => $oneOff
      ]);
    }
    
    echo '<script src="js/submit_data.js"></script>';
    echo "<script>ListSchedule(\"" . $dayTxt . "\", \"" . $solText . "\");</script>";
    $newMarker = getMarker($dayTxt, $solText);
    $colID = $dayTxt . $solText;
    echo '<script>$("#' . $colID . '").html("' . $newMarker . '");</script>';
  }
?>
