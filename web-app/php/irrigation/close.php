<?php
session_start();
if(isset($_SESSION['loggedin'])){
  $url = "http://control-cluster-service:5000/closeall";
  $data = array();
  
  $options = array(
      'http' => array(
          'header'  => "Content-type: application/x-www-form-urlencoded",
          'method'  => 'POST',
          'content' => http_build_query($data)
      )
  );
  $context  = stream_context_create($options);
  $resp = file_get_contents($url, false, $context);
  var_dump($resp);
}
// do nothing if not logged in
?>
