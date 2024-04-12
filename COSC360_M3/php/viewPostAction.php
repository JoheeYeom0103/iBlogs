<?php
require("dbConnect.php");

// Retrieve the postId from the URL query parameter
if(isset($_GET['id'])) {
    $postId = $_GET['id'];

    // Prepare and execute the query to retrieve the post details
    $stmt = mysqli_prepare($connection, "SELECT * FROM post WHERE PostId = ?");
    mysqli_stmt_bind_param($stmt, "i", $postId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if a post with the given postId exists
    if(mysqli_num_rows($result) > 0) {
        $post = mysqli_fetch_assoc($result);

        echo "<div class='diary-container'>        
                <div class='header'>
                <img src='images/title.svg' class='title-icon'/>
                <h2 class='inputHint'>" . $post['Title'] . "</h2>
                <p><strong>By: </strong>" . $post['UserId'] . "</p>
                <p><strong>Date: </strong>" . $post['DateOfPost'] . "</p>
                <hr class='line'>
                </br>
                <img src='images/cateogry.svg' class='category-icon'/>
                <p class='inputHint'><strong>Category: </strong>" . $post['Category'] . "</p>
            </div>"; 

          // only allow users who's post it is edit access by setting the textarea to read only for viewers
          echo "<div class='content'>
          <form method='POST' >
              <textarea class='diary-entry' name='diary-entry'" . ($_SESSION['userId'] !== $post['UserId'] ? ' readonly' : '') . ">" . $post['Content'] . "</textarea>
              <input type='hidden' name='postId' value='" . $postId . "'>
              <button type='submit' name='editSubmit' " . ($_SESSION['userId'] !== $post['UserId'] ? 'style="display: none;"' : '') . ">Save Edit</button>
          </form>
        </div>";

        if (isset($_POST['editSubmit'])) {
            $editedContent = $_POST['diary-entry'];
            $postId = $_POST['postId'];
        
            // Update the post content in the database
            $updateStmt = mysqli_prepare($connection, "UPDATE post SET Content = ? WHERE PostId = ?");
            mysqli_stmt_bind_param($updateStmt, "si", $editedContent, $postId);
            if (mysqli_stmt_execute($updateStmt)) {
                echo "Edit saved successfully.";
                header("Location: ViewPostPage.php?id=" . $postId);
            } else {
                echo "Error saving edit: " . mysqli_error($connection);
            }
        }
        

        // Retrieve and display comments for this post
        $commentStmt = mysqli_prepare($connection, "SELECT * FROM comment WHERE PostId = ?");
        mysqli_stmt_bind_param($commentStmt, "i", $postId);
        mysqli_stmt_execute($commentStmt);
        $commentResult = mysqli_stmt_get_result($commentStmt);

        // Check if any comments were returned
        if(mysqli_num_rows($commentResult) > 0) {
            echo "<p><strong>Comments</strong></p>";
            while($comment = mysqli_fetch_assoc($commentResult)) {
                echo "<div style='border: 1px black solid; font-size: 11px; margin-top: 20px'>";
                    
                echo "<tr rowspan='3'>
                <td>
                    <p><strong>User: </strong>" . $comment['UserId'] . "</p>
                    <p><strong>Date: </strong>" . $comment['DateOfComment'] . "</p>
                    <p><strong> </strong>" . $comment['Content'] . "</p>
                    </td>

                    <td>
                    <form class='deleteCommentForm' id='deleteCommentForm" . $comment['CommentId'] . "'method='post' action='".$_SERVER["PHP_SELF"]."'>
                    <input type='hidden' name='deleteComment' value='" . $comment['CommentId'] . "'>
                    <button type='submit' name='deleteComment' " . ($_SESSION['userId'] !== $comment['UserId'] ? 'style="display: none;"' : '') . ">Delete</button>
                    </form>
                    </td>

                    </tr>
                    
                </div>";
            } // end while

            // delete comment
            if (isset($_POST['deleteComment'])) {
                $deleteCommentId = $_POST['deleteComment'];
                $deleteCommentSql = "DELETE FROM comment WHERE CommentId = ?";
                $deleteCommentPstmt = mysqli_prepare($connection, $deleteCommentSql);
                mysqli_stmt_bind_param($deleteCommentPstmt, "s", $deleteCommentId);
                if (mysqli_stmt_execute($deleteCommentPstmt)) {
                    echo "Comment deleted successfully.";
                } else {
                    echo "Error deleting comment: " . mysqli_error($connection);
                }
            } // end of if for deleting a comment  

        } else {
            echo "<p>No comments found</p>";
        }

    } else {
        echo "Post not found";
    }
} else {
    echo "link is invalid (post id not found)";
}

mysqli_close($connection);
