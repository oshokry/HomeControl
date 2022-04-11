<?php
session_start();
ob_start();
require_once 'lib/util.php';

$username = $_POST['username'];
$password_from_login = $_POST['password'];
$result = getDB('Irrigation')::queryFirstRow("SELECT * FROM Credentials where username = %s", $username);
$password_from_db = $result['password'];
if (password_verify($password_from_login, $password_from_db)) {
  $_SESSION['loggedin'] = 1;
  $_SESSION['userName'] = $username;
}
else {
  $_SESSION['loginFailed'] = 1;
}

header('Location: index.php');
?>
