<?php
// PHP code for database connection and form processing
$host = "localhost";
$database = "iblog";
$user = "joy";
$db_password = "joy5767";

// Create connection
$connection = mysqli_connect($host, $user, $db_password, $database);

// Error message
$error = mysqli_connect_error();

// If connection is not successful (If any error message exists)
if ($error != null) {
    $error_message = "Connection failed: " . mysqli_connect_error();
    exit("<p>$error_message</p>");
}

// Initialize variables
$old_userId = $old_firstname = $old_lastname = $old_password = $old_email = $old_img = "";
$userIdClass = $firstNameClass = $lastNameClass = $passwordClass = $passwordConfirmationClass = $emailClass = "";

// Hardcoded user ID assuming the user is logged in
session_start();
$old_userId = $SESSION_['userId'];

// Fetch user details from the database
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

    mysqli_stmt_close($pstmt);
}

// Function to get input value
function getInputValue($field) {
    global $old_userId, $old_firstname, $old_lastname, $old_password, $old_email;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // If the user submits, retrieve form data
        return isset($_POST[$field]) ? $_POST[$field] : '';
    } else {
        // If not submitted, return old values
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

// Function to validate field
function isFieldValid($field, $value) {
    switch ($field) {
        case 'userId':
            return !(empty($value) || strlen($value) < 4 || strlen($value) > 16);
        case 'password':
            return !(empty($value) || strlen($value) < 12 || strlen($value) > 14);
        case 'passwordConfirmation':
            // Check if password and passwordConfirmation match
            return ($value == getInputValue('password'));
        case 'email':
            return !(empty($value) || strpos($value, '@') === false);
        default:
            return true;
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['submit'])) {
        
        // Validate form fields
        $isValid = true;
        $new_userId = getInputValue('userId');
        $new_firstName = getInputValue('firstName');
        $new_lastName = getInputValue('lastName');
        $new_password = getInputValue('password');
        $new_email = getInputValue('email');

        // Validate each field
        foreach ($_POST as $field => $value) {
            if (!isFieldValid($field, $value)) {
                $isValid = false;
                break;
            }
        }

        // If all fields are valid, update user data
        if ($isValid) {
            $updateSQL = "UPDATE User SET UserId=?, FirstName=?, LastName=?, Email=?, Password=? WHERE UserId=?";
            $updatePstmt = mysqli_prepare($connection, $updateSQL);

            if ($updatePstmt) {
                mysqli_stmt_bind_param($updatePstmt, "ssssss", $new_userId, $new_firstName, $new_lastName, $new_email, $new_password, $old_userId);
                $success = mysqli_stmt_execute($updatePstmt);

                if ($success) {
                    // Update old values with new ones
                    $old_userId = $new_userId;
                    $old_firstname = $new_firstName;
                    $old_lastname = $new_lastName;
                    $hashed_password = md5($new_password);
                    $old_password = $hashed_password;
                    $old_email = $new_email;
                    echo "<script>alert('Changes have been successfully saved!')</script>";
                } else {
                    echo "<script>alert('Failed to save changes')</script>";
                }

                mysqli_stmt_close($updatePstmt);
            }
        } else {
            // If not valid, show error message
            echo "<script>alert('Correct the highlighted fields')</script>";
        }
    } else if (isset($_POST['cancel'])) {
        // Redirect to a page after cancellation
        header('Location: editaccountpage.php');
        exit; 
    }
}

if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === UPLOAD_ERR_OK) {
    // Check if the file is an image
    $file_type = mime_content_type($_FILES['profileImage']['tmp_name']);
    if (strpos($file_type, 'image') !== false) {
        // Define upload directory
        $upload_dir = 'uploads/';
        
        // Generate unique file name
        $file_name = uniqid('profile_img_') . '.' . pathinfo($_FILES['profileImage']['name'], PATHINFO_EXTENSION);
        // Move the uploaded file to the upload directory
        if (move_uploaded_file($_FILES['profileImage']['tmp_name'], $upload_dir . $file_name)) {
            // Update database with new image path
            $new_img = $upload_dir . $file_name;
            $updateSQL = "UPDATE User SET ProfileImg=? WHERE UserId=?";
            $updatePstmt = mysqli_prepare($connection, $updateSQL);
            if ($updatePstmt) {
                mysqli_stmt_bind_param($updatePstmt, "ss", $new_img, $old_userId);
                $success = mysqli_stmt_execute($updatePstmt);
                if ($success) {
                    $old_img = $new_img;
                } else {
                    echo "<script>alert('Failed to save changes')</script>";
                }
                mysqli_stmt_close($updatePstmt);
            }
        } else {
            echo "<script>alert('Failed to move uploaded file')</script>";
        }
    } else {
        echo "<script>alert('Uploaded file is not an image')</script>";
    }
} else {
    echo "<script>alert('No file uploaded or error occurred')</script>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Page</title>
    <link rel="stylesheet" href="css/headerfooter.css">
    <link rel="stylesheet" href="css/editAccount.css">

    <!-- Font Files -->
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Aboreto' rel='stylesheet'>
    <!-- Font Files -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Get the file input element
        var fileInput = document.getElementById("profileImage");

        var fileName = "";

        // Get the image preview element
        var imgPreview = document.getElementById("profileImgPreview");

        // Get the file name display element
        var fileNameDisplay = document.getElementById("fileNameDisplay");

        // Add event listener to file input element
        fileInput.addEventListener("change", function() {
            // Check if a file is selected
            if (fileInput.files && fileInput.files[0]) {
                var reader = new FileReader();

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

        // Add event listener to the change button
        document.getElementById("changeBtn").addEventListener("click", function() {
            // Trigger click event on the file input element
            fileInput.click();
        });
    });
    
    </script>


</head>
<body>
    <header>
        <h1>iBlogs</h1>
        <nav>
            <ul>
                <li><a href="loginPage.php" class="menu">Log In</a></li>
                <li><a href="signup.php" class="menu">Sign Up</a></li>
            </ul>
        </nav>
    </header> 

    <div id="profile-details">
        
        <form method="post" action="" id="profile-img" class="user-profile" enctype="multipart/form-data">
            <h2>Edit Account</h2>
            <h3 class="profile-heading">Photo</h3>
            <!-- Add the "circular" class to the image tag -->
            <img id="profileImgPreview" src="<?php echo $old_img !== '' ? $old_img : 'images/userIcon.svg'; ?>" alt="User Icon" class="circular">
            <input type="file" name="profileImage" id="profileImage" style="display: none;">
            <button type="button" name="changeImg" id="changeBtn">Change</button>
        </form>

        <form method="post" action="" id="profile-form" class="user-profile">
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
                <button type="submit" name="cancel" class="buttons">Cancel</button>
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
            <img src="images/instagram.png" alt="Instagram" width="30">
        </p>
    </footer>

</body>
</html>