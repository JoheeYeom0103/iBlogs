<?php
include("php/dbConnect.php");

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
            $user_id_db = $row['UserId']; // Change variable name to $user_id_db
            echo "<tr id='tableData'><td colspan=2>" . $user_id_db . "</td></tr>";

            // Retrieve and display the user's post information
            $postSql = "SELECT * FROM post WHERE UserId = ?";
            $postPstmt = mysqli_prepare($connection, $postSql);
            mysqli_stmt_bind_param($postPstmt, "s", $user_id_db);
            mysqli_stmt_execute($postPstmt);
            $postResult = mysqli_stmt_get_result($postPstmt);

            if(mysqli_num_rows($postResult) > 0) {
                echo "<tr><td colspan='2'><table class='postTable'><tr><th>Post ID</th><th colspan=2>Content</th></tr>";
                while ($postRow = mysqli_fetch_assoc($postResult)) {

                    echo "<tr><td>" . $postRow['PostId'] . "</td><td>" . $postRow['Content'] . "</td><td>
                    <form class='deleteForm' id='deleteForm" . $postRow['PostId'] . "' method='post' action='".$_SERVER["PHP_SELF"]."'>
                    <input type='hidden' name='delete' value='" . $postRow['PostId'] . "'>
                    <button type='submit'>Delete</button>
                    </form></td></tr>";
                    // echo "<tr><td>" . $postRow['PostId'] . "</td><td>" . $postRow['Content'] . "</td><td><button id='delete' name='delete' onclick='deleteRow(this)'>Delete</button></td></tr>";
                }
                echo "</table></td></tr>";
            }

            // Retrieve and display the user's comment information
            $commentSql = "SELECT * FROM comment WHERE UserId = ?";
            $commentPstmt = mysqli_prepare($connection, $commentSql);
            mysqli_stmt_bind_param($commentPstmt, "s", $user_id_db);
            mysqli_stmt_execute($commentPstmt);
            $commentResult = mysqli_stmt_get_result($commentPstmt);

            if(mysqli_num_rows($commentResult) > 0) {
                echo "<tr><td colspan='2'><table class='commentTable'><tr><th>Comment ID</th><th colspan=2>Content</th></tr>";
                while ($commentRow = mysqli_fetch_assoc($commentResult)) {
                    echo "<tr><td>" . $commentRow['CommentId'] . "</td><td>" . $commentRow['Content'] . "</td><td><button id='delete' name='delete' onclick='deleteRow(this)'>Delete</button></td></tr>";
                }
                echo "</table></td></tr>";
            }

        }

        // // below is the code for deleting a post, but it is not working properly
        // // if delete button is clicked, delete the post from the database 
        // if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //     if (isset($_POST['delete'])) {
        //         $deletePostId = $_POST['delete'];
        //         $deleteSql = "DELETE FROM post WHERE PostId = ?";
        //         $deletePstmt = mysqli_prepare($connection, $deleteSql);
        //         mysqli_stmt_bind_param($deletePstmt, "s", $deletePostId);
        //         mysqli_stmt_execute($deletePstmt);
        //     }
        // }


        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
            $deletePostId = $_POST['delete'];
            $deleteSql = "DELETE FROM post WHERE PostId = ?";
            $deletePstmt = mysqli_prepare($connection, $deleteSql);
            mysqli_stmt_bind_param($deletePstmt, "s", $deletePostId);
            if (mysqli_stmt_execute($deletePstmt)) {
                echo "Post deleted successfully.";
                // header("Refresh:0; url=adminMain.php");
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
