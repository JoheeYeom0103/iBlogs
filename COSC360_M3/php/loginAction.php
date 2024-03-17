<?php
include("data.php");
include("dbConnect.php");
// start the session
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // get input from the form
    $username = $_POST["username"];
    $password = $_POST["password"];
    $hashedPass = md5($password);

    $errors = isEmptyLogin($username, $password);

    if(empty($errors)){
        $sql = "SELECT * FROM member WHERE Username = ?";
        // use prepared statement
        $stmt =  mysqli_prepare($connection, $sql);
        // Bind parameters to the query
        mysqli_stmt_bind_param($stmt, "s", $username);
        // Execute the prepared statement
        mysqli_stmt_execute($stmt);
        // Get the result set
        $result = mysqli_stmt_get_result($stmt);

        // check to see if we return ONE result from the query
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_assoc($result);
            $dbPass = $row["Password"];

            // check to see if the pass matches
            if($hashedPass === $dbPass) {
                // set the session for the user
                $_SESSION['username'] = $username;
                // send to home page
                header("Location: ../explore.php"); 
                exit();
            }else {
                $errors[] = "<p> Invalid Password. </p>";
                 // Store errors in session
                $_SESSION['loginErrors'] = $errors;
                
                // Redirect back to login page
                header("Location: ../loginPage.php");
                exit();
            }
        }else {
            $errors[] = "<p> Cannot locate an account with the specified username </p>";
             // Store errors in session
             $_SESSION['loginErrors'] = $errors;
                
             // Redirect back to login page
             header("Location: ../loginPage.php");
             exit();
        }
            
    }else{
        // set the errors array to include a message about the invalid credentials
        $errors[] = "Username or password is incorrect";
         // Store errors in session
         $_SESSION['loginErrors'] = $errors;
                
         // Redirect back to login page
         header("Location: ../loginPage.php");
         exit();
    }
    
        
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
