<?php
  session_start();
  if(!isset($_SESSION['loggedin'])){
    header('Location: index.php');
  }
?>

<html>
<title>Settings</title>
<head></head>
<body>
  [<a href="irrigation/water.php">Water</a>]
  [<a href="irrigation/schedule.php">Water Schedule</a>]
  [<a href="temperature/today.php">Temperature</a>]
  <b>[Settings]</b>
  [<a href="logout.php">Logout</a>]
  <br /><br />
<?php
  if(isset($_SESSION['pwChangeSuccess'])){
    echo '✔️Password changed successfully<br />';
    unset($_SESSION['pwChangeSuccess']);
  }
  else {
    echo '[<a href="changepw.php">Change Password</a>]';
  }
?>
  <br />
</body>
</html>
