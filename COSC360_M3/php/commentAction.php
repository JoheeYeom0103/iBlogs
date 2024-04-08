<?php 

require("dbConnectZ.php");

session_start();

$PostId = $_SESSION['PostId'];


if($_SERVER['REQUEST_METHOD'] == 'POST') {
    // user can add a comment or delete a comment
    if(isset($_POST['addComment'])) {
        $commenter = $_POST['commenter'];
        $content = $_POST['content'];

        $stmt = mysqli_prepare($connection, "INSERT INTO comment (PostId, Commenter, Content) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $postId, $commenter, $content);
        mysqli_stmt_execute($stmt);
    } else if(isset($_POST['deleteComment'])) {
        // you need to be using jquery for this to work. look at adminDisplayUsers for an example
        $commentId = $_POST['commentId'];

        $stmt = mysqli_prepare($connection, "DELETE FROM comment WHERE CommentId = ?");
        mysqli_stmt_bind_param($stmt, "s", $commentId);
        mysqli_stmt_execute($stmt);
    }
}

?>
