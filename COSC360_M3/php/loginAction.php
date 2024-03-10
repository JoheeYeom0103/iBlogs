<?php
include("data.php");
// start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // DB connection should go here
    // Example: include("db_connect.php");

    $username = $_POST["username"];
    $password = $_POST["password"];

    $errors = validateLogin($username, $password);

    if(empty($errors)){
        header("Location: ../explore.php"); 
    }else{
        header("Location: ../loginPage.php");
    }

}

function validateLogin($username, $password){
    $errors = array(); // Initialize array
    // These would need to be changed from global variables when DB is 
    // created to avoid security issues! This is for testing only!
    global $DB_USERNAME;
    global $DB_PASSWORD;

    if(empty($username)){
        $errors[] = "Username is required.";
    }

    if(empty($password)){
        $errors[] = "Password is required.";
    }

    if($username !== $DB_USERNAME){
        $errors[] = "Username does not match.";
    }

    if($password !== $DB_PASSWORD){
        $errors[] = "Password does not match.";
    }

    // store in a session so that we can display the 
    // errors on the login page
    $_SESSION['loginErrors'] = $errors;

    return $errors;
}

