<?php
include("php/dbConnectZ.php");

// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
//     $deletePostId = $_POST['delete'];
//     $deleteSql = "DELETE FROM post WHERE PostId = ?";
//     $deletePstmt = mysqli_prepare($connection, $deleteSql);
//     mysqli_stmt_bind_param($deletePstmt, "s", $deletePostId);
//     if (mysqli_stmt_execute($deletePstmt)) {
//         echo "Post deleted successfully.";
//     } else {
//         echo "Error deleting post: " . mysqli_error($connection);
//     }
//     exit; // Exit to prevent further processing
// }

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $deletePostId = $_POST['delete'];
    $deleteSql = "DELETE FROM post WHERE PostId = ?";
    $deletePstmt = mysqli_prepare($connection, $deleteSql);
    mysqli_stmt_bind_param($deletePstmt, "s", $deletePostId);
    if (mysqli_stmt_execute($deletePstmt)) {
        echo "Post deleted successfully.";
    } else {
        echo "Error deleting post: " . mysqli_error($connection);
    }
    
    header('...application/json');
    echo json_encode(["success => true"]);
    exit;
?>
