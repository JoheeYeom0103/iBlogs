<?php

$host = "cosc360.ok.ubc.ca";
$database = "db_23751415";
$user = "23751415";
$password = "23751415";

$connection = mysqli_connect($host, $user, $password, $database);

$error = mysqli_connect_error();
if($error != null)
{
  $output = "<p>Unable to connect to database!</p>";
  exit($output);
}