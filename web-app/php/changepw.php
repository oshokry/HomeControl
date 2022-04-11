<?php
  session_start();
  if(!isset($_SESSION['loggedin'])){
    header('Location: index.php');
  }
?>

<html>
<title>Change Password</title>
<head>
<style>
	form  { display: table;      }
	p     { display: table-row;  }
	label { display: table-cell; }
	input { display: table-cell; }
</style>
</head>
<body>
  [<a href="irrigation/water.php">Water</a>]
  [<a href="irrigation/schedule.php">Water Schedule</a>]
  [<a href="temperature/today.php">Temprature</a>]
  <b>[Settings]</b>
  [<a href="logout.php">Logout</a>]
  <br /><br />
<?php
  if(isset($_SESSION['wrongCurrentPW'])){
    echo '❌ Incorrect current password<br />';
    unset($_SESSION['wrongCurrentPW']);
  }
  if(isset($_SESSION['emptyPW'])){
    echo '❌ Password can not be empty<br />';
    unset($_SESSION['emptyPW']);
  }
  if(isset($_SESSION['mismatchedPW'])){
    echo '❌ Password mismatch<br />';
    unset($_SESSION['mismatchedPW']);
  }
?>
  <form action="savepw.php" method="post">
    <p>
	    <label for="password0">Enter current password</label>
      <input type="password" name="password0" id="password0" />
    </p>
    <p>
	    <label for="password1">Enter new password</label>
      <input type="password" name="password1" id="password1" />
    </p>
    <p>
	    <label for="password2">Repeat new password</label>
      <input type="password" name="password2" id="password2" />
    </p>
  	<input type="submit" value="Change Password">
	</form>
  <br />
</body>
</html>
