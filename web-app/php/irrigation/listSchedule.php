<?php
session_start();
if(isset($_SESSION['loggedin'])) {
  $dayTxt = $_POST['dayTxt'];
  $solText = $_POST['solText'];
  $_SESSION['dayTxt'] = $dayTxt;
  $_SESSION['solText'] = $solText;
  
//  echo $dayTxt ."<br/>";
//  echo $solText ."<br/>";
  require_once 'helper.php';
  if(isGoodDay($dayTxt) && isGoodSol($solText)) {
    listSchedule($dayTxt, $solText);
  }
}
// do nothing if not logged in

  function listSchedule($dayTxt, $solText) {
    require_once '../lib/util.php';
    $DB = getDB('Irrigation');
    
    $sqlStatement = "SELECT * from TimingSchedule WHERE dayOfWeek = \"";
    $sqlStatement .= $dayTxt;
    $sqlStatement .= "\" and solenoidNumber = \"";
    $sqlStatement .= $solText;
    $sqlStatement .= "\" ORDER BY id";
    $result = $DB::query($sqlStatement);
  
    echo '
    <script src="js/jquery-3.4.1.js"></script>
    <script src="js/jquery.json-2.4.min.js"></script>
    <script src="js/submit_data.js"></script>
    <br/>
    <br/>
    <table id = "Entries" class = "table">
      <caption>Entries</caption>
      <tr>
        <th scope="col">Select</th>
        <th scope="col">Start Time</th>
        <th scope="col">Length Seconds</th>
        <th scope="col">Enabled?</th>
        <th scope="col">One off?</th>
      </tr>
    ';
  
    $i = 0;
    foreach ($result as $row) {
      $enabledChecked = "";
      if($row['enabled']) {
        $enabledChecked = " checked=\"\"";
      }
      $oneOffChecked = "";
      if($row['oneOff']) {
        $oneOffChecked = " checked=\"\"";
      }
      echo "<tr>";
      echo '<td><input type="checkbox" name="row"/></td>';
      echo '<td><input type="text" name ="startTime" value = "' . $row["startTime"] . '"/></td>';
      echo '<td><input type="text" name="lengthSeconds" value="' . $row["lengthSeconds"] . '"/></td>';
      echo '<td><input type="checkbox" name="enabled" ' . $enabledChecked . '/></td>';
      echo '<td><input type="checkbox" name="oneOff" ' . $oneOffChecked . '/></td>';
      echo "</tr>";
      $i++;
    }
  
    echo '
    </table>
    <br/>
    <input type="button" id="AddButton" onclick="AddEntry();" value="Add" class="button"/>
    <input type="button" id="DeleteButton" onclick="DeleteEntries();" value="Delete" class="button"/>
    <input type="button" id="SaveButton" onclick="SaveEntries();" value="Save" class="button"/>
    ';
  }
?>
