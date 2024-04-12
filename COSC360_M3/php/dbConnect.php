<?php

$host = "localhost";
$database = "iblogs";
$user = "tatkg24";
$password = "C0sc360!!";

$connection = mysqli_connect($host, $user, $password, $database);

$error = mysqli_connect_error();
if($error != null)
{
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}