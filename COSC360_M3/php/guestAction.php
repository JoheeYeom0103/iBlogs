<?php
session_start();

// Unset any existing session variables
$_SESSION = array();

// Set $_SESSION['userId'] to null or any other value indicating a guest user
$_SESSION['userId'] = null;

// Redirect to the explore/home page
header("Location: ../explore.php");
exit();

