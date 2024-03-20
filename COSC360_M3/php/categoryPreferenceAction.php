<?php

session_start();
include("dbConnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $checkedValues = array();
    foreach ($_POST["categories"] as $value) {
        $checkedValues[] = $value;
    }

    if(numCategoriesChecked($checkedValues) == true) {
        if(isset($_SESSION['userId'])){
            // retrieve userId from the session that was created upon signing up
            $userId = $_SESSION['userId'];

            echo "$userId: " . $userId;

            $interestIds = array();
            foreach ($checkedValues as $interestName) {
                $sql = "SELECT InterestId FROM interest WHERE InterestName = ?";
                $stmt = mysqli_prepare($connection, $sql);
                mysqli_stmt_bind_param($stmt, "s", $interestName);

                // execute the query
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $interestId);
                mysqli_stmt_fetch($stmt);

                // set the categoryIds array equal to the id in the interest table
                $interestIds[] = $interestId;
                // close the prepared statement
                mysqli_stmt_close($stmt);
            }

            // insert the newly signed up user's category selection into the database
            $InsertSql = "INSERT INTO userinterest (userId, interestId) VALUES(?,?)";
            $stmt =  mysqli_prepare($connection, $InsertSql);
            // Bind parameters in the interestIds array to the query
            foreach($interestIds as $id) {
                mysqli_stmt_bind_param($stmt, "ss", $userId, $id);
                // Execute the prepared statement
                mysqli_stmt_execute($stmt);
            }

            // close the prepared statement
            mysqli_stmt_close($stmt);
            
            // send the user to the explore page
            header("Location: ../explore.php");

        }else{
            // send the user back to the category preference page if there is a problem
            // with their input.
            echo "<p>Session is not set</p>";

            // header("Location: ../categoryPreferencesPage.php");
        }//end 
    }else{
        // header("Location: ../categoryPreferencesPage.php");
        echo "<p>too little or too many categories chosen</p>";
    }//end category check
}

// validate that 6 categories have been selected
function numCategoriesChecked($checkedArray){
    $numCheckedBoxes = count($checkedArray);

    if($numCheckedBoxes !== 6){
        return false;
    }else{
        return true;
    }
}
