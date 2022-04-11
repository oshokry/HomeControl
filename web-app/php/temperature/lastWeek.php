<?php
  require_once 'temperatureLib.php';
  confirmLogin();
?>

<html>
<title>Temprature of today</title>
  <head>
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script type="text/javascript">
    google.load( 'visualization', '1', { 'packages': [ 'corechart' ] } );
    google.setOnLoadCallback( drawChart );
    
    function drawChart() {
      var data = new google.visualization.DataTable();

      data.addColumn( 'string', 'C' );
      data.addColumn( 'number', 'Temperature' );
      data.addColumn( 'number', 'Humidity' );

<?php
  $values = loadSensorData("SELECT * from sensor WHERE date(timestamp) between date(NOW() - INTERVAL 1 WEEK) and curdate() order by timestamp asc");
?>

      var options = {
        title: 'Home Sensor',
        series: {0:{targetAxisIndex:0}, 1:{targetAxisIndex:1}},
        vAxes: {
          0: {title: 'Temperature'},
          1: {title: 'Humidity'},
        },
        hAxis: {title: 'Date'},
        colors: ['red','blue'] 
      };
  
      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw( data, options);
  }
    </script>
  </head>

<body>
  <div id="tempratureDiv" style="width: 100%; height: 100%;">
    [<a href="../irrigation/water.php">Water</a>]
    [<a href="../irrigation/schedule.php">Water Schedule</a>]
    <b>[Temperature]</b>
    [<a href="../settings.php">Settings</a>]
    [<a href="../logout.php">Logout</a>]
    <br /><br />
    [<a href="today.php">Today</a>]
    [<a href="yesterday.php">Yesterday</a>]
    <b>[Last Week]</b>
    <br /><br />
    <?php printMinMax($values) ?>
    <div id="chart_div"style= "width: 100%; height: 500;"/>
  </div> 
</body>
</html>
