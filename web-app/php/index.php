<?php
  session_start();
  if(isset($_SESSION['loggedin'])){
    header('Location: temperature/today.php');
}?>

<html>
<title>Home Control Center</title>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
	form  { display: table;      }
	p     { display: table-row;  }
	label { display: table-cell; }
	input { display: table-cell; }
</style>
</head>
<body> 
<?php
  if(isset($_SESSION['loginFailed'])){
    echo '❌ Login failed!<br />';
    unset($_SESSION['loginFailed']);
}?>
  <form action="login.php" method="post">
    <p>
	    <label for="username">User Name</label>
      <input type="text" name="username" id="username" />
    </p>
    <p>
	    <label for="password">Password</label>
      <input type="password" name="password" id="password" />
    </p>
	<input type="submit" value="Login">
	</form>
</body>
</html>
