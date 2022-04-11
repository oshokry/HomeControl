<?php
  session_start();
  if(!isset($_SESSION['loggedin'])){
    header('Location: ../index.php');
  }
?>

<?php include 'helper.php';?>

<html>
<title>Water Schedule</title>
<head>
<script src="js/jquery-3.4.1.js"></script>
<script src="js/submit_data.js"></script>
<link href="../css/table.css" rel="stylesheet" type="text/css"/>
</head>
<body>
  [<a href="water.php">Water</a>]
  <b>[Water Schedule]</b>
  [<a href="../temperature/today.php">Temperature</a>]
    [<a href="../settings.php">Settings</a>]
  [<a href="../logout.php">Logout</a>]
  <br /><br />
<table id = "schedule" class = "table">
  <caption><b>Irrigation Schedule<br />Total time in seconds</b></caption>
  <tr>
    <th></th>
    <th scope="col">SAT</th>
    <th scope="col">SUN</th>
    <th scope="col">MON</th>
    <th scope="col">TUE</th>
    <th scope="col">WED</th>
    <th scope="col">THU</th>
    <th scope="col">FRI</th>
  </tr>
  <tr>
    <th scope="row">S1</th>
    <td id="SATS1"><?php echo getMarker("SAT", "S1");?></td>
    <td id="SUNS1"><?php echo getMarker("SUN", "S1");?></td>
    <td id="MONS1"><?php echo getMarker("MON", "S1");?></td>
    <td id="TUES1"><?php echo getMarker("TUE", "S1");?></td>
    <td id="WEDS1"><?php echo getMarker("WED", "S1");?></td>
    <td id="THUS1"><?php echo getMarker("THU", "S1");?></td>
    <td id="FRIS1"><?php echo getMarker("FRI", "S1");?></td>
  </tr>
  <tr>
    <th scope="row">S2</th>
    <td id="SATS2"><?php echo getMarker("SAT", "S2");?></td>
    <td id="SUNS2"><?php echo getMarker("SUN", "S2");?></td>
    <td id="MONS2"><?php echo getMarker("MON", "S2");?></td>
    <td id="TUES2"><?php echo getMarker("TUE", "S2");?></td>
    <td id="WEDS2"><?php echo getMarker("WED", "S2");?></td>
    <td id="THUS2"><?php echo getMarker("THU", "S2");?></td>
    <td id="FRIS2"><?php echo getMarker("FRI", "S2");?></td>
  </tr>
  <tr>
    <th scope="row">S3</th>
    <td id="SATS3"><?php echo getMarker("SAT", "S3");?></td>
    <td id="SUNS3"><?php echo getMarker("SUN", "S3");?></td>
    <td id="MONS3"><?php echo getMarker("MON", "S3");?></td>
    <td id="TUES3"><?php echo getMarker("TUE", "S3");?></td>
    <td id="WEDS3"><?php echo getMarker("WED", "S3");?></td>
    <td id="THUS3"><?php echo getMarker("THU", "S3");?></td>
    <td id="FRIS3"><?php echo getMarker("FRI", "S3");?></td>
  </tr>
  <tr>
    <th scope="row">S4</th>
    <td id="SATS4"><?php echo getMarker("SAT", "S4");?></td>
    <td id="SUNS4"><?php echo getMarker("SUN", "S4");?></td>
    <td id="MONS4"><?php echo getMarker("MON", "S4");?></td>
    <td id="TUES4"><?php echo getMarker("TUE", "S4");?></td>
    <td id="WEDS4"><?php echo getMarker("WED", "S4");?></td>
    <td id="THUS4"><?php echo getMarker("THU", "S4");?></td>
    <td id="FRIS4"><?php echo getMarker("FRI", "S4");?></td>
  </tr>
  <tr>
    <th scope="row">S5</th>
    <td id="SATS5"><?php echo getMarker("SAT", "S5");?></td>
    <td id="SUNS5"><?php echo getMarker("SUN", "S5");?></td>
    <td id="MONS5"><?php echo getMarker("MON", "S5");?></td>
    <td id="TUES5"><?php echo getMarker("TUE", "S5");?></td>
    <td id="WEDS5"><?php echo getMarker("WED", "S5");?></td>
    <td id="THUS5"><?php echo getMarker("THU", "S5");?></td>
    <td id="FRIS5"><?php echo getMarker("FRI", "S5");?></td>
  </tr>
  <tr>
    <th scope="row">S6</th>
    <td id="SATS6"><?php echo getMarker("SAT", "S6");?></td>
    <td id="SUNS6"><?php echo getMarker("SUN", "S6");?></td>
    <td id="MONS6"><?php echo getMarker("MON", "S6");?></td>
    <td id="TUES6"><?php echo getMarker("TUE", "S6");?></td>
    <td id="WEDS6"><?php echo getMarker("WED", "S6");?></td>
    <td id="THUS6"><?php echo getMarker("THU", "S6");?></td>
    <td id="FRIS6"><?php echo getMarker("FRI", "S6");?></td>
  </tr>
</table>

<script>
$("#schedule tbody td").click(function ()
  {
    var $table = $(this).closest('table');
    $(this).closest('table').find('td').not(this).removeClass('selected');  
    $(this).toggleClass('selected');
    var dayTxt = "Null";
    var solText = "Null";
    if($(this).hasClass('selected')) {
      dayTxt = $(this).closest('table').find('th').eq($(this).index()).html();
  //    alert(dayTxt);
      solText = $(this).closest('tr').find('th').eq(0).html();
  //    alert(solText);
    }
    ListSchedule(dayTxt, solText);
  });
</script>

<div id="listSchedule">
</div>
<br />
<div id="testSchedule">
</div>
 
</body>
</html>
