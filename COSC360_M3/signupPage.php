<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sign Up</title>

  <!-- stylesheets -->
  <link rel="stylesheet" href="css/signupPage.css">
  <link rel="stylesheet" href="css/headerfooter.css">
  <link rel="stylesheet" href="css/phpErrorMessageStyling.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Aboreto" rel="stylesheet">
  <!-- stylesheets -->

  <!-- scripts -->
  <script src="script/signupPage.js"></script>
  <?php include("php/signupAction.php"); ?>
  <!-- scripts -->
</head>

<body>
  <header>
    <h1>iBlogs</h1>
  </header>

  <section id="signupsection">
    <h3>Sign Up</h3>
    <form id="signUpForm" action="php/signupAction.php" method="post">
      <div class="signup-container">

        <input class="firstname-input" type="text" name="firstname" placeholder="First Name">
        <span class="tooltip-firstname">
          <img src="images/helpIcon-01.svg" alt="Help Icon" class="help-icon">
          <span class="tooltip-message">Please enter your first name</span>
        </span>

        <input class="lastname-input" type="text" name="lastname" placeholder="Last Name">
        <span class="tooltip-lastname">
          <img src="images/helpIcon-01.svg" alt="Help Icon" class="help-icon">
          <span class="tooltip-message">Please enter your last name</span>
        </span>

        <input class="email-input" type="email" name="email" placeholder="Email">
        <span class="tooltip-email" >
          <img src="images/helpIcon-01.svg" alt="Help Icon" class="help-icon">
          <span class="tooltip-message">Please enter your address in a valid format including '@'</span>
        </span>

        <input class="username-input" type="text" name="username" placeholder="Username">
        <span class="tooltip-username">
          <img src="images/helpIcon-01.svg" alt="Help Icon" class="help-icon">
          <span class="tooltip-message">Please enter a username and ensure that it is between 4-16 characters</span>
        </span>

        <input class="password-input" type="password" name="password" placeholder="Password">
        <span class="tooltip-password">
          <img src="images/helpIcon-01.svg" alt="Help Icon" class="help-icon">
          <span class="tooltip-message">Please enter a password and ensure that is it between 12-14 characters</span>
        </span>

        <input class="confirm-password-input" type="password" name="confirmPass" placeholder="Confirm Password">
        <span class="tooltip-confirmPassword">
          <img src="images/helpIcon-01.svg" alt="Help Icon" class="help-icon">
          <span class="tooltip-message">Please confirm your password and ensure that it matches what you've previously
            typed</span>
        </span>

        <?php

          // php code to display stored error messages
          if(isset($_SESSION['loginErrors'])){
            // iterate through the errors 
            foreach($_SESSION['loginErrors'] as $error){
                // echo the error(s) to the screen under the confirm pass field
                echo "<p class='error-message'>$error</p>";
            }
            // After errors are displayed unset the session array
            unset($_SESSION["loginErrors"]);
          }

        ?>

        <div class="terms">
          <input class="terms-checkbox" type="checkbox" required>
          <p class="termstext">By signing up, you agree to our Terms, Data Policy, and Cookies Policy.</p>
        </div>

        <button class="signup-button" type="submit">Sign Up</button>
        
      </div>
    </form>
  </section>

  <section>
    <div class="loginBox">
      <p>Already have an account?</p>
        <a href="loginPage.php">
          <button class="login-button">Log In</button>
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