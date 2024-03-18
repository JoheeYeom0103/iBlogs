<!-- EditAccountPage_Action.php -->
<?php
$isValid = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["userId"], $_POST["firstName"], $_POST["lastName"], $_POST["password"], 
    $_POST["passwordConfirmation"], $_POST["email"], $_POST["interest"])) {
        
        $userId = trim($_POST["userId"]);
        $firstName = trim($_POST["firstName"]);
        $lastName = trim($_POST["lastName"]);
        $password = trim($_POST["password"]);
        $passwordConfirmation = trim($_POST["passwordConfirmation"]);
        $email = trim($_POST["email"]);
        $interest = trim($_POST["interest"]);

        // Validation checks
        if (empty($userId) || strlen($userId) < 4 || strlen($userId) > 16) {
            $isValid = false;
            $userIdClass = 'highlight'; // highlight if not valid
        } else {
            $userIdClass = ''; // No highlight if valid
        }

        if (empty($password) || strlen($password) < 12 || strlen($password) > 14 || $password != $passwordConfirmation) {
            $isValid = false;
            $passwordClass = 'highlight'; // highlight if not valid
        } else {
            $passwordClass = ''; // No highlight if valid
        }

        if (empty($email) || strpos($email, '@') === false) {
            $isValid = false;
            $emailClass = 'highlight'; // highlight if not valid
        } else {
            $emailClass = ''; // No highlight if valid
        }

        // Echo out the class for CSS styling
        echo "<style>#userId { background-color: #F9EDE2; }</style>";
        echo "<style>#password { background-color: #F9EDE2; }</style>";
        echo "<style>#passwordConfirmation { background-color: #F9EDE2; }</style>";
        echo "<style>#email { background-color: #F9EDE2; }</style>";

        // You can add more validation checks for other fields if needed
    }
}
?>
