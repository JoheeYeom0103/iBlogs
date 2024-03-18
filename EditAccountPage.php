<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Page</title>
    <link rel="stylesheet" href="css/headerfooter.css">
    <link rel="stylesheet" href="css/editStyling.css">

    <!--Font Files-->
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Aboreto' rel='stylesheet'>
    <!--Font Files-->

    <?php 

        function getInputFor($inputName) {
            // initialise the variable to hold retrieved input
            $value = "";
            // if any value is received in the txtSearch input field
            if(isset($_POST[$inputName])) {
                // retrieve the value
                $value = $_POST[$inputName];
            }
            return $value;
        }        
         

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if(isset($_POST["userId"], $_POST["firstName"], $_POST["lastName"], $_POST["password"],  $_POST["passwordConfirmation"], $_POST["email"])) {
                // Validation logic
                $userId = trim($_POST["userId"]);
                $firstName = trim($_POST["firstName"]);
                $lastName = trim($_POST["lastName"]);
                $password = trim($_POST["password"]);
                $passwordConfirmation = trim($_POST["passwordConfirmation"]);
                $email = trim($_POST["email"]);
                $interest = trim($_POST["interest"]);

                  // Check user ID
                if (empty($userId) || strlen($userId) < 4 || strlen($userId) > 16) {
                    $isValid = false;
                    $userIdClass = 'highlight'; 
                }
                // Check password
                if (empty($password) || strlen($password) < 12 || strlen($password) > 14 || $password != $passwordConfirmation) {
                    $isValid = false;
                    $passwordClass = 'highlight'; 
                    $passwordConfirmationClass = 'highlight';
                }

                // Check email
                if (empty($email) || strpos($email, '@') === false) {
                    $isValid = false;
                    $emailClass = 'highlight'; 
                }
            }
        }
    ?>
</head>
<body>
    <header>
        <h1>iBlogs</h1>
        <nav>
            <ul>
                <li><a href="#" class="menu">Log In</a></li>
                <li><a href="#" class="menu">Sign Up</a></li>
            </ul>

        </nav>
    </header> 

    <div id="profile-details">
        <form method="post" action="" id="profile-form" class="user-profile">

            <h2>Edit Account</h2>
            <h3 class="profile-heading">Photo</h3>
            <img src="images/usericon-01.svg" alt="User Icon">
            <button id="changeBtn">Change</button>

            <div class="profile-field">
                <label for="userId">User ID:</label>
                <!-- userId -->
                <input type="text" class="required <?php echo $userIdClass; ?>" id="userId" name="userId" placeholder="Your user ID" value="<?php echo getInputFor("userId")?>" />
                <img src="images/helpIcon-01.svg" alt="helpIcon" class="helpIcon" id="useridHelp">
                <p>Please enter a user id and ensure that it is between 4-16 characters</p>
            </div>

            <div id="userNames">
                <div class="profile-field" id="firstname-field">
                    <label for="firstName">First Name:</label>
                    <!-- firstName -->
                    <input type="text" class="required <?php echo $firstNameClass; ?>" id="firstName" name="firstName" placeholder="Your first name" value="<?php echo getInputFor("firstName")?>" />
                    <img src="images/helpIcon-01.svg" alt="helpIcon" class="helpIcon" id="firstnameHelp">
                    <p>Please enter your first name</p>
                </div>

                <div class="profile-field" id="lastname-field">
                    <label for="lastName">Last Name:</label>
                    <!-- lastName -->
                    <input type="text" class="required <?php echo $lastNameClass; ?>" id="lastName" name="lastName" placeholder="Your last name" value="<?php echo getInputFor("lastName")?>" />
                    <img src="images/helpIcon-01.svg" alt="helpIcon" class="helpIcon" id="lastnameHelp">
                    <p>Please enter your last name</p>
                </div>
            </div>

        
            <div id="userPw">
                <div class="profile-field" id="pw-field">
                    <label for="password">Password:</label>
                    <!-- password -->
                    <input type="password" class="required <?php echo $passwordClass; ?>" id="password" name="password" placeholder="Your password" value="<?php echo getInputFor("password")?>" />
                    <img src="images/helpIcon-01.svg" alt="helpIcon" class="helpIcon" id="pwHelp">
                    <p>Please enter a password and ensure that it is between 12-14 characters</p>                      
                </div>

                <div class="profile-field" id="pwconfirm-field">
                    <label for="passwordConfirmation">PW Confirm:</label>
                    <!-- passwordConfirmation -->
                    <input type="password" class="required <?php echo $passwordConfirmationClass; ?>" id="passwordConfirmation" name="passwordConfirmation" placeholder="Your password" value="<?php echo getInputFor("passwordConfirmation")?>" /> 
                    <img src="images/helpIcon-01.svg" alt="helpIcon" class="helpIcon" id="pwconfirmHelp">
                    <p>Please confirm your password and ensure that it matches what you've previously typed</p>
                </div>
            </div>

            <div class="profile-field">
                <label for="email">Email:</label>
                <!-- email -->
                <input type="email" class="required <?php echo $emailClass; ?>" id="email" name="email" placeholder="Your email address" value="<?php echo getInputFor("email")?>" />
                <img src="images/helpIcon-01.svg" alt="helpIcon" class="helpIcon" id="emailHelp">
                <p>Please enter your address in a valid format including '@'</p>
            </div>

            <div id="buttons">
                <button type="cancel" name = "cancel" class="buttons">Cancel</button>
                <button type="submit" class="buttons">Save</button>
            </div>
        </form>
    </div>

    <footer>
        <p id="footerCopyrightMsg">&copy; 2024 iBlogs. All rights reserved.</p>
        <p id="footerPhoneNum">778-123-4567</p>
        <p id="footerEmail">iblogs@blogger.com</p>
        <p>
            <img src="images/twitter (1).png" alt="Twitter" width="30">
            <img src="images/facebook.png" alt="Facebook" width="30">       
            <img src="images/insta.png" alt="Instagram" width="30">
        </p>
    </footer>

</body>
</html>
