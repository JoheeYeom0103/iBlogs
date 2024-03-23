<?php

include('php/dbConnect.php');

// Initialize old variables
$old_userId = $old_firstname = $old_lastname = $old_password = $old_email = $old_img = "";
$userIdClass = $firstNameClass = $lastNameClass = $passwordClass = $passwordConfirmationClass = $emailClass = "";

/******************************* SESSION *******************************/
session_start();
$old_userId = $_SESSION['userId'];
// $old_userId = isset($_SESSION_['userId']) ? $SESSION_['userId'] : 'jane_smith';
/******************************* SESSION *******************************/

// Assign the old variables with data stored in the database
$sql = "SELECT FirstName, LastName, Password, Email, ProfileImg FROM User WHERE UserId = ?";
$pstmt = mysqli_prepare($connection, $sql);

if ($pstmt) {
    // Bind parameters to the prepared statement
    mysqli_stmt_bind_param($pstmt, "s", $old_userId);

    // Execute the prepared statement
    mysqli_stmt_execute($pstmt);

    // Bind result variables
    mysqli_stmt_bind_result($pstmt, $old_firstname, $old_lastname, $old_password, $old_email, $old_img);

    // Fetch values
    mysqli_stmt_fetch($pstmt);

    // Close connection
    mysqli_stmt_close($pstmt);
}

// Function to get input value
function getInputValue($field) {
    global $old_userId, $old_firstname, $old_lastname, $old_password, $old_email;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // If the form has been submitted, return the submitted value
        return isset($_POST[$field]) ? $_POST[$field] : '';
    } else {
        // If the form has not been submitted, return previosly saved values
        switch ($field) {
            case 'userId':
                return $old_userId;
            case 'firstName':
                return $old_firstname;
            case 'lastName':
                return $old_lastname;
            case 'password':
                return $old_password;
            case 'passwordConfirmation':
                return $old_password;
            case 'email':
                return $old_email;
            default:
                return '';
        }
    }
}

// Function to validate fields
function isFieldValid($field, $value) {
    switch ($field) {
        case 'userId':
            return !(empty($value) || strlen($value) < 4 || strlen($value) > 16);
        case 'password':
            return !(empty($value) || strlen($value) < 12 || strlen($value) > 14);
        case 'passwordConfirmation':
            return ($value == getInputValue('password'));
        case 'email':
            return !(empty($value) || strpos($value, '@') === false);
        default:
            return true;
    }
}


include('php/EditAccountPage_Action.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Page</title>

    <!-- External css & js -->
    <link rel="stylesheet" href="css/headerfooter.css">
    <link rel="stylesheet" href="css/EditAccountPage.css">
    <script src="validation.js"></script>
    <!-- External css & js -->

    <!-- Font Files -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Aboreto' rel='stylesheet'>
    <!-- Font Files -->

    <!-- Embeded script to deal with dynamic display of new image -->
    <script>

        document.addEventListener("DOMContentLoaded", function() {

        var fileName = "";
        
        // Input file button element
        var fileInput = document.getElementById("changeImg");
        // Image element
        var imgPreview = document.getElementById("profileImgPreview");

        // If the input file button is clicked
        fileInput.addEventListener("change", function() {
            // Check if a file is selected
            if (fileInput.files && fileInput.files[0]) {

                // Create a FileReader object
                var reader = new FileReader();
                // When the FileReader has successfully read the file contents
                reader.onload = function(e) {
                    // Update the src attribute of the image preview element
                    imgPreview.src = e.target.result;
                    // Display the file name
                    fileName= fileInput.files[0].name;
                };

                // Read the selected file as a data URL
                reader.readAsDataURL(fileInput.files[0]);
            }
        });

    });
    
    </script>
</head>
<body>
    <header>
        <h1>iBlogs</h1>
        <nav>
            <ul>
            <li>
              <form action="php/logoutAction.php" method="post">
                <button class="logoutButton" type="submit" name="logout"> Log Out </button>
              </form>
            </li>
            <li><a href="AccountPage.php" class="menu">@<?php echo $old_userId ?></a></li>
            </ul>
        </nav>
    </header> 

    <div id="profile-details">
        
        <form method="post" action="" id="profile-form" class="user-profile" enctype="multipart/form-data">
            <h2>Edit Account</h2>
            <h3 class="profile-heading">Photo</h3>
            <!-- Add the "circular" class to the image tag -->
            <!-- removed uploads file path from here -->
            <img id="profileImgPreview" src="<?php echo $old_img !== '' ? $old_img : 'images/userIcon.svg'; ?>" alt="User Icon" class="circular">
            <label for="changeImg" class="file-upload-button">
                Change
                <input type="file" name="changeImg" id="changeImg">
            </label>

            <div class="profile-field">
                <label for="userId">User ID:</label>
                <!-- userId -->
                <input type="text" class="required <?php echo (isset($_POST['submit']) && !isFieldValid('userId', $_POST['userId'])) ? 'highlight' : ''; ?>" id="userId" name="userId" placeholder="Your user ID" value="<?php echo getInputValue('userId'); ?>" />
                <img src="images/helpIcon-01.svg" alt="helpIcon" class="helpIcon" id="firstnameHelp">
                <p>Please enter a user id and ensure that it is between 4-16 characters</p>
            </div>

            <div id="userNames">
                <div class="profile-field" id="firstname-field">
                    <label for="firstName">First Name:</label>
                    <!-- firstName -->
                    <input type="text" class="required <?php echo (isset($_POST['submit']) && !isFieldValid('firstName', $_POST['firstName'])) ? 'highlight' : ''; ?>" id="firstName" name="firstName" placeholder="Your first name" value="<?php echo getInputValue('firstName'); ?>" />
                    <img src="images/helpIcon-01.svg" alt="helpIcon" class="helpIcon" id="firstnameHelp">
                    <p>Please enter your first name</p>
                </div>

                <div class="profile-field" id="lastname-field">
                    <label for="lastName">Last Name:</label>
                    <!-- lastName -->
                    <input type="text" class="required <?php echo (isset($_POST['submit']) && !isFieldValid('lastName', $_POST['lastName'])) ? 'highlight' : ''; ?>" id="lastName" name="lastName" placeholder="Your last name" value="<?php echo getInputValue('lastName'); ?>" />
                    <img src="images/helpIcon-01.svg" alt="helpIcon" class="helpIcon" id="lastnameHelp">
                    <p>Please enter your last name</p>
                </div>
            </div>

            <div id="userPw">
                <div class="profile-field" id="pw-field">
                    <label for="password">Password:</label>
                    <!-- password -->
                    <input type="password" class="required <?php echo (isset($_POST['submit']) && !isFieldValid('password', $_POST['password'])) ? 'highlight' : ''; ?>" id="password" name="password" placeholder="Your password" value="<?php echo getInputValue('password'); ?>" />
                    <img src="images/helpIcon-01.svg" alt="helpIcon" class="helpIcon" id="pwHelp">
                    <p>Please enter a password and ensure that it is between 12-14 characters</p>                      
                </div>

                <div class="profile-field" id="pwconfirm-field">
                    <label for="passwordConfirmation">PW Confirm:</label>
                    <!-- passwordConfirmation -->
                    <input type="password" class="required <?php echo (isset($_POST['submit']) && !isFieldValid('passwordConfirmation', $_POST['passwordConfirmation'])) ? 'highlight' : ''; ?>" id="passwordConfirmation" name="passwordConfirmation" placeholder="Your password" value="<?php echo getInputValue('passwordConfirmation'); ?>" /> 
                    <img src="images/helpIcon-01.svg" alt="helpIcon" class="helpIcon" id="pwconfirmHelp">
                    <p>Please confirm your password and ensure that it matches what you've previously typed</p>
                </div>
            </div>

            <div class="profile-field">
                <label for="email">Email:</label>
                <!-- email -->
                <input type="email" class="required <?php echo (isset($_POST['submit']) && !isFieldValid('email', $_POST['email'])) ? 'highlight' : ''; ?>" id="email" name="email" placeholder="Your email address" value="<?php echo getInputValue('email'); ?>" />
                <img src="images/helpIcon-01.svg" alt="helpIcon" class="helpIcon" id="emailHelp">
                <p>Please enter your address in a valid format including '@'</p>
            </div>


            <div id="buttons">
                <button type="button" class="buttons" name = 'cancel' onclick="window.location.href='editaccountpage.php'">Cancel</button>
                <button type="submit" class="buttons" name="submit">Save</button>
            </div>

        </form>

    </div>

    <footer>
        <p>&copy; 2024 iBlogs. All rights reserved.</p>
        <p>778-123-4567</p>
        <p>iblogs@blogger.com</p>
        <p>
            <img src="images/twitter.png" alt="Twitter" width="30">
            <img src="images/facebook.png" alt="Facebook" width="30">       
            <img src="images/insta.png" alt="Instagram" width="30">
        </p>
    </footer>

</body>
</html>