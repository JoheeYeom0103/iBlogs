<?php
include("php/dbConnectZ.php");


session_start();

$userId = $_SESSION['userId'];


// Default search key
$searchKey = "";

// Default SQL query to retrieve all users
$sql = "SELECT * FROM User";

// Modify the SQL query to search for specific user if search key is provided
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['search'])) {
        $searchKey = $_POST['search'];
        $searchKey = '%' . $searchKey . '%';

        $sql = "SELECT * FROM User WHERE UserId LIKE ?";

    }
}

// Prepare and execute the SQL statement
$pstmt = mysqli_prepare($connection, $sql);
if ($pstmt) {
    // If search key is provided, bind it to the prepared statement
    if (!empty($searchKey)) {
        mysqli_stmt_bind_param($pstmt, "s", $searchKey);
    }

    mysqli_stmt_execute($pstmt);

    $result = mysqli_stmt_get_result($pstmt);

    // If there are users found
    if (mysqli_num_rows($result) > 0) {

        // Display table headers
        echo "<div class='usersOnPlatform'><table><tr><th>Username</th></tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            $userId = $row['UserId'];
            echo "<tr id='tableData'><td colspan=2>" . $userId . "</td></tr>";

            // Retrieve and display the user's post information
            $postSql = "SELECT * FROM post WHERE UserId = ?";
            $postPstmt = mysqli_prepare($connection, $postSql);
            mysqli_stmt_bind_param($postPstmt, "s", $userId);
            mysqli_stmt_execute($postPstmt);
            $postResult = mysqli_stmt_get_result($postPstmt);

            if(mysqli_num_rows($postResult) > 0) {
                // echo "<tr><td colspan='2'><table class='postTable'><tr><th>Post ID</th><th colspan=2>Content</th></tr>";
                // while ($postRow = mysqli_fetch_assoc($postResult)) {
                //     echo "<tr><td>" . $postRow['PostId'] . "</td><td>" . $postRow['Content'] . "</td><td><button id='delete' name='delete' onclick='deleteRow(this)'>Delete</button></td></tr>";
                // }
                // echo "</table></td></tr>";

                echo "<tr><td colspan='2'><table class='postTable'><tr><th>Post ID</th><th colspan=2>Content</th></tr>";
                while ($postRow = mysqli_fetch_assoc($postResult)) {

                    
                    echo "<tr><td>" . $postRow['PostId'] . "</td><td>" . $postRow['Content'] . "</td><td>
                    <form class='deleteForm' id='deleteForm" . $postRow['PostId'] . "' method='post' action='".$_SERVER["PHP_SELF"]."'>
                    <input type='hidden' name='delete' value='" . $postRow['PostId'] . "'>
                    <button type='submit'>Delete</button>
                    </form></td></tr>";

                    // echo "<tr><td>" . $postRow['PostId'] . "</td><td>" . $postRow['Content'] . "</td><td>
                    // <button type='button' onclick='deletePost(" . $postRow['PostId'] . ")'>Delete</button>
                    // </td></tr>";

                    

                    
                    
                }
            }


            // Retrieve and display the user's comment information
            $postSql = "SELECT * FROM comment WHERE UserId = ?";
            $postPstmt = mysqli_prepare($connection, $postSql);
            mysqli_stmt_bind_param($postPstmt, "s", $userId);
            mysqli_stmt_execute($postPstmt);
            $postResult = mysqli_stmt_get_result($postPstmt);

            if(mysqli_num_rows($postResult) > 0) {
                echo "<tr><td colspan='2'><table class='commentTable'><tr><th>Comment ID</th><th colspan=2>Content</th></tr>";
                while ($postRow = mysqli_fetch_assoc($postResult)) {
                    echo "<tr><td>" . $postRow['CommentId'] . "</td><td>" . $postRow['Content'] . "</td><td><button id='delete' name='delete' onclick='deleteRow(this)'>Delete</button></td></tr>";
                }
                echo "</table></td></tr>";
            }

        }


        // below is for Deleting post

        // if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit_delete'])) {
        //     if (isset($_POST['delete'])) {
        //         $deletePostId = $_POST['delete'];
        //         $deleteSql = "DELETE FROM post WHERE PostId = ?";
        //         $deletePstmt = mysqli_prepare($connection, $deleteSql);
        //         mysqli_stmt_bind_param($deletePstmt, "s", $deletePostId);
        //         if (mysqli_stmt_execute($deletePstmt)) {
        //             echo "Post deleted successfully.";
        //         } else {
        //             echo "Error deleting post: " . mysqli_error($connection);
        //         }
        //     }
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
            exit; // Exit to prevent further processing
        }
        


    // No user found
    } else {
        echo "<tr><td colspan='2'><h4>User Not found :(</h4></td></tr>";
    }
    echo "</table></div>";

    mysqli_free_result($result);
} else {
    echo "Prepared statement error: " . mysqli_error($connection);
}
mysqli_close($connection);

