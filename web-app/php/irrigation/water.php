<?php
  session_start();
  if(!isset($_SESSION['loggedin'])){
    header('Location: ../index.php');
  }
?>

<html>
<title>Water</title>
<head>
<script src="js/jquery-3.4.1.js"></script>
<script src="js/submit_data.js"></script>
<link href="../css/style.css" rel="stylesheet" type="text/css"/>
</head>
<body>
  <b>[Water]</b>
  [<a href="schedule.php">Water Schedule</a>]
  [<a href="../temperature/today.php">Temperature</a>]
  [<a href="../settings.php">Settings</a>]
  [<a href="../logout.php">Logout</a>]
  <br /><br />
  <form id="IrrigateForm" method="post">
    <div class="slidecontainer">
      <input type="range" id="minutes" min="0" max="10" value="0" class="slider">
    </div><br/>
    <div class="slidecontainer">
      <input type="range" id="seconds" min="0" max="59" value="0" class="slider">
    </div>
    <p>Minutes: <span id="minutes_value"></span>, Seconds: <span id="seconds_value"></span></p>
    <script src="js/slider_value.js"></script>
    <input type="button" id="S1Button" onclick="SubmitS1();" value="S1" class="button"/>
    <br /><br />
    <input type="button" id="S2Button" onclick="SubmitS2();" value="S2" class="button"/>
    <br /><br />
    <input type="button" id="S3Button" onclick="SubmitS3();" value="S3" class="button"/>
    <br /><br />
    <input type="button" id="S4Button" onclick="SubmitS4();" value="S4" class="button"/>
    <br /><br />
    <input type="button" id="S5Button" onclick="SubmitS5();" value="S5" class="button"/>
    <br /><br />
    <input type="button" id="S6Button" onclick="SubmitS6();" value="S6" class="button"/>
    <br /><br />
    <input type="button" id="CloseButton" onclick="SubmitClose();" value="Close All" class="button"/>
   </form>
</body>
</html>
