<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // add db connection here

    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPass = $_POST["confirmPass"];

    $errors = validateSignup($firstname, $lastname, $email, $username, $password, $confirmPass);

    if(empty($errors)){
        // this is where we would save to DB
        // also we would probably change this redirect url to be
        // header("Location: ../AccountPage.php?username=$username");
        header("Location: ../AccountPage.php");
    }else{
        // if there are errors, send the user back to the signup page 
        header("Location: ../signupPage.php");
    }

}

// function to validate the signup information
function validateSignup($firstname, $lastname, $email, $username, $password, $confirmPass){
    // Initialize array
    $errors = array(); 
   
    // Validate last name
    if(empty($lastname)){
        $errors[] = "Last name is required.";
    }

    // Validate email
    if(empty($email)){
        $errors[] = "Email is required.";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Invalid email format.";
    }

    // Validate username
    if(empty($username)){
        $errors[] = "Username is required.";
    } elseif(strlen($username) < 4 || strlen($username) > 16){
        $errors[] = "Username must be between 4 and 16 characters.";
    }

    // Validate password
    if(empty($password)){
        $errors[] = "Password is required.";
    } elseif(strlen($password) < 12 || strlen($password) > 14){
        $errors[] = "Password must be between 12 and 14 characters.";
    }

    // Validate confirm password
    if(empty($confirmPass)){
        $errors[] = "Confirm password is required.";
    } elseif($confirmPass != $password){
        $errors[] = "Passwords do not match.";
    }
    
    // store in a session array so that we can display the 
    // errors on the signup page
    $_SESSION['loginErrors'] = $errors;

    return $errors;

}