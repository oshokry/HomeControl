<?php
  session_start();
  if(!isset($_SESSION['loggedin'])){
    header('Location: index.php');
  }

  $success = true;
  
  // confirm current password
  require_once 'lib/util.php';
  $DB = getDB('Irrigation');
  $username = $_SESSION['userName'];
  $password_from_login = $_POST['password0'];
  $result = $DB::queryFirstRow("SELECT * FROM Credentials where username = %s", $username);
  $password_from_db = $result['password'];
  if(!password_verify($password_from_login, $password_from_db)) {
    $_SESSION['wrongCurrentPW'] = 1;
    $success = false;
  }

  // confirm new password
  $password1 = $_POST['password1'];
  $password2 = $_POST['password2'];
  if(empty($password1) or empty($password2)) {
    $_SESSION['emptyPW'] = 1;
    $success = false;
  }
  if($password1 != $password2) {
    $_SESSION['mismatchedPW'] = 1;
    $success = false;
  }
    
  if(!$success) {
    header('Location: changepw.php');
    exit();
  }
  
  $hashedPassword = password_hash($password1, PASSWORD_DEFAULT);
  $DB::update('Credentials', ['password' => $hashedPassword], 'username=%s', $username);

  $_SESSION['pwChangeSuccess'] = 1;
  header('Location: settings.php');
?>
