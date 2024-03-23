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
        // Update the SQL query to check if the user is an administrator
        $sql = "SELECT * FROM user u INNER JOIN administrator a ON u.UserId = a.AdminId WHERE u.UserId = ?";
        $pstmt = mysqli_prepare($connection, $sql);

        if ($pstmt) {
            // Bind parameters to the prepared statement
            mysqli_stmt_bind_param($pstmt, 's', $userId);

            // Execute the prepared statement
            mysqli_stmt_execute($pstmt);

            // Get result
            $result = mysqli_stmt_get_result($pstmt);

            // Fetch the row
            $row = mysqli_fetch_assoc($result);

            // Check if the query returned a row
            if ($row) {
                // Check if the password matches
                if (trim($row['Password']) === $hashedPassword) {
                    // User is an administrator, set the session for the user
                    $_SESSION['userId'] = $userId;
                    // Redirect to the admin main page
                    header("Location: ../adminMain.php"); 
                    exit();
                } else {
                    // Password is incorrect, show an error message
                    $errors[] = "Password is incorrect.";
                }
            } else {
                // Not an administrator, show an error message
                $errors[] = "You are not authorized to access this page.";
            }

            // Close the prepared statement
            mysqli_stmt_close($pstmt);
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
