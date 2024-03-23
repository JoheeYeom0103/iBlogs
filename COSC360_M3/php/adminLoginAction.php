<?php
include("dbConnect.php");
// start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // get input from the form
    $userId = $_POST["username"];
    $password = $_POST["password"];
    $hashedPassword = trim(md5($password));

    $errors = isEmptyLogin($userId, $password);

    if(empty($errors)){
        // Update the SQL query to use a direct query
        $sql = "SELECT * FROM user WHERE UserId IN (SELECT UserId FROM administrator)";

        // Execute the SQL query
        $result = mysqli_query($connection, $sql);

        // Check if the query was successful
        if ($result) {
            // Process the result
            if(mysqli_num_rows($result) == 1){
                $row = mysqli_fetch_assoc($result);
                $dbPass = trim($row["Password"]);
                if($hashedPassword === $dbPass){
                    // set the session for the user
                    $_SESSION['userId'] = $userId;
                    // send to home page
                    header("Location: ../adminMain.php"); 
                    exit();
                }else{
                    $errors[] = "Password is incorrect";
                }
            }else{
                // set the errors array to include a message about the invalid credentials
                $errors[] = "Username or password is incorrect";
            }
        } else {
            // Handle the query error
            $errors[] = "Database query error: " . mysqli_error($connection);
        }
    }

    // Store errors in session
    $_SESSION['loginErrors'] = $errors;

    // Redirect back to login page
    header("Location: ../adminLogin.php");
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
?>
