<?php
if (isset($_POST["logout"])) {
    // Unset all of the session variables.
    $_SESSION = array();
    // Destroy the session.
    session_destroy();
    var_dump($_SESSION);
    print_r(var_dump($_SESSION));
    // Redirect to the login page after signing out.
    header("Location: ../loginPage.php");
    exit();
}