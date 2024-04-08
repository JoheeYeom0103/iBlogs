<?php 

require("dbConnectZ.php");

session_start();

$PostId = $_SESSION['PostId'];


if($_SERVER['REQUEST_METHOD'] == 'GET') {

    // Prepare and execute the query
    $stmt = mysqli_prepare($connection, "SELECT * FROM post WHERE PostId = ?");
    mysqli_stmt_bind_param($stmt, "s", $postId);
    mysqli_stmt_execute($stmt);
    $results = mysqli_stmt_get_result($stmt);

    // Check if any results were returned
    if(mysqli_num_rows($results) > 0) {
        // Fetch the row
        $row = mysqli_fetch_assoc($results);

        // Output the post details
        echo "Title: " . $row["Title"] . "<br>";
        echo "Date: " . $row["DateOfPost"] . "<br>";
        echo "Category: " . $row["Category"] . "<br>";
        echo "Content: " . $row["Content"] . "<br>";

        $commentStmt = mysqli_prepare($connection, "SELECT * FROM comment WHERE PostId = ?");
        mysqli_stmt_bind_param($commentStmt, "s", $postId);
        mysqli_stmt_execute($commentStmt);
        $commentResults = mysqli_stmt_get_result($commentStmt);

        // Check if any comments were returned
        if(mysqli_num_rows($commentResults) > 0) {
            // Output the comments
            echo "<h2>Comments</h2>";
            while($commentRow = mysqli_fetch_assoc($commentResults)) {
                echo "Commenter: " . $commentRow["Commenter"] . "<br>";
                echo "Comment: " . $commentRow["Content"] . "<input type='hidden' name='deleteComment' value='" . $postRow['PostId'] . "'>
                <button type='submit'>Delete</button>" . "<br>";
            }
        } else {
            echo "No comments found";
        }


        // user can add a comment or delete a comment 
        echo "<form method='post' action='commentAction.php'>";

        
    } else {
        echo "Post not found";
    }

}

mysqli_close($connection);

?>
