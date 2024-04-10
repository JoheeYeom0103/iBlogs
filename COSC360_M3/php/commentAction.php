<?php

require("dbConnectZ.php");

session_start();

if(isset($_SESSION['userId']) && isset($_POST['postId']) && isset($_POST['commentContent'])) {

    $postId = $_POST['postId'];
    $commentContent = $_POST['commentContent'];
    $userId = $_SESSION['userId'];

    // Insert the comment into the database
    $stmt = mysqli_prepare($connection, "INSERT INTO comment (PostId, UserId, DateOfComment, Content) VALUES (?, ?, NOW(), ?)");
    mysqli_stmt_bind_param($stmt, "iss", $postId, $userId, $commentContent);
    mysqli_stmt_execute($stmt);

    mysqli_close($connection);

    // Redirect back to the post details page after adding the comment
    header("Location: ../ViewPostPage.php?id=$postId");
    exit();
} else {
    // Handle cases where required data is missing
    echo "Error: Required data is missing.";
}
?>
