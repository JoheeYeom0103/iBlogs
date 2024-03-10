<?php
    // start the session
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>

    <!-- stylesheets -->
    <link rel="stylesheet" href="css/loginPage.css">
    <link rel="stylesheet" href="css/headerfooter.css">
    <link rel="stylesheet" href="css/phpErrorMessageStyling.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Aboreto" rel="stylesheet">
    <!-- stylesheets -->

    <!-- Scripts -->
    <script src="script/loginPageScript.js"></script>
    <!-- Scripts -->

</head>

<body>
    <header>
        <h1><a href="explore.html" style="text-decoration: none; color: #362204;">iBlogs</a></h1>
    </header>

    <section id="loginsection">
        <h3>Login</h3>
        <form id="loginForm" action="php/loginAction.php" method="post">
            <div class="login-container">

                <input class="username-input" type="text" name="username" placeholder="username">
                <span class="tooltip-username">
                    <img src="images/helpIcon-01.svg" alt="Help Icon" class="help-icon">
                    <span class="tooltip-message">Please enter the username associated with your account</span>
                </span>

                <input class="password-input" type="password" name="password" placeholder="password">
                <span class="tooltip-password">
                    <img src="images/helpIcon-01.svg" alt="Help Icon" class="help-icon">
                    <span class="tooltip-message">Please enter the password associated with your account</span>
                </span>

                <?php
                    // check to see if the session array is set
                    if(isset($_SESSION['loginErrors'])){
                        // iterate through the errors 
                        foreach($_SESSION['loginErrors'] as $error){
                            // echo the error(s) to the screen under the password
                            echo "<p class='error-message'>$error</p>";
                        }
                        // After errors are displayed unset the session array
                        unset($_SESSION["loginErrors"]);
                    }
                ?>

                <button class="login-button" type="submit">Log In</button>
            </div>
        </form>
    </section>

    <section>
        <div class="forgotPass">
            <a href="#">
                <button class="forgot-password-button">Forgot Password?</button>
            </a>
        </div>
    </section>

    <section>
        <p id="not-a-user">Don't have an account with us?</p>
        <div class="signup-guest">
            <a href="signupPage.html">
                <button class="signup-button" id="signup-button">Sign Up</button>
            </a>
            <a href="explore.html">
                <button class="guest-button">Continue as guest</button>
            </a>
        </div>
    </section>

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