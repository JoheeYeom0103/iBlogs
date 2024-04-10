<?php
include("dbConnectZ.php");
// start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // get input from the form
    $userId = $_POST["username"];
    $password = $_POST["password"];
    $hashedPassword = trim(md5($password));

    $errors = isEmptyLogin($userId, $password);

    if(empty($errors)){
        $sql = "SELECT * FROM user WHERE UserId = ?";
        // use prepared statement
        $stmt =  mysqli_prepare($connection, $sql);
        // Bind parameters to the query
        mysqli_stmt_bind_param($stmt, "s", $userId);

        // Execute the prepared statement
        mysqli_stmt_execute($stmt);

        // Get the result set
        $result = mysqli_stmt_get_result($stmt);

        // check to see if we return ONE result from the query
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            $dbPass = trim($row["Password"]);
            if($hashedPassword === $dbPass){
                // set the session for the user
                $_SESSION['userId'] = $userId;
                // send to home page
                header("Location: ../explore.php"); 
                exit();
            }else{
                $errors[] = "Password is incorrect";
            }
        }else{
            // set the errors array to include a message about the invalid credentials
            $errors[] = "Username or password is incorrect";
        }
        
        // end the prepared statement
        mysqli_stmt_close($stmt);
    }

    // Store errors in session
    $_SESSION['loginErrors'] = $errors;
    
    // Redirect back to login page
    header("Location: ../loginPage.php");
    exit();
}

// close DB connection after the script finishes running
mysqli_close($connection);

function isEmptyLogin($username, $password){
    $errors = array(); // Initialize array

    if(empty($username)){
        $errors[] = "Username is required.";
    }

    if(empty($password)){
        $errors[] = "Password is required.";
    }

    return $errors;
}
