<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include('dbConnection.php');

    /******************************* SESSION *******************************/
    session_start();
    $userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : 'jane_smith';
    $profileImg = ''; // Initialize $profileImg to avoid PHP notice
    /******************************* SESSION *******************************/

    // Assign the old variables with data stored in the database
    $imgSql = "SELECT ProfileImg FROM User WHERE UserId = ?";
    $imgPstmt = mysqli_prepare($connection, $imgSql);

    if ($imgPstmt) {
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($imgPstmt, "s", $userId);

        // Execute the prepared statement
        mysqli_stmt_execute($imgPstmt);

        // Bind result variables
        mysqli_stmt_bind_result($imgPstmt, $profileImg);

        // Fetch values
        mysqli_stmt_fetch($imgPstmt);

        // Close connection
        mysqli_stmt_close($imgPstmt);
    }

    $postSql = "SELECT Date(DateOfPost), Title, Category, ShareOption FROM Post WHERE UserId = ?";
    $postPstmt = mysqli_prepare($connection, $postSql);

    if ($postPstmt) {
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($postPstmt, "s", $userId);

        // Execute the prepared statement
        mysqli_stmt_execute($postPstmt);

        // Bind result variables
        mysqli_stmt_bind_result($postPstmt, $postDate, $title, $category, $shareOption);

        // Create arrays to hold public and private posts
        $publicPosts = [];
        $privatePosts = [];

        while (mysqli_stmt_fetch($postPstmt)) {
            // Check the share option and assign to appropriate array
            if ($shareOption === 'Public') {
                $publicPosts[] = [
                    'PostDate' => $postDate,
                    'Title' => $title,
                    'Category' => $category
                ];
            } else {
                $privatePosts[] = [
                    'PostDate' => $postDate,
                    'Title' => $title,
                    'Category' => $category
                ];
            }
        }

        // Close connection
        mysqli_stmt_close($postPstmt);
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Page</title>
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="css/headerfooter.css">
    <link rel="stylesheet" href="css/account.css">
    <!-- CSS Files -->

    <!-- JavaScript Files -->
    <script src="script/account.js"></script>
    <!-- JavaScript Files -->
  

    <!--Font Files-->
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Aboreto' rel='stylesheet'>
    <!--Font Files-->

</head>

<body>

    <header>
        <h1>iBlogs</h1>
        <nav>
            <ul>
                <li><a href="#" class="menu">@<?php echo $userId ?></a></li>
            </ul>
        </nav>
    </header> 

    <div class="user-profile">
        <img src="<?php echo $profileImg !== '' ? './uploads/' . $profileImg : 'images/userIcon.svg'; ?>" alt="User Icon" class="circular">
        <p><?php echo $userId ?></p>
        <div class="button-container">
            <a href="EditAccountPage.php"><button class="round-button">Edit Account</button></a>
            <a href="CreatePost.php"><button class="round-button">Create Post</button></a>
        </div>
        <div class="link-container">
            <a href="#" id="viewPublic" class="view-link" onclick="showPublicPosts()">Public</a>
            |
            <a href="#" id="viewPrivate" class="view-link" onclick="showPrivatePosts()">Private</a>
            <hr />
        </div>
    </div>

    <div class="user-post">
        <?php $i = 0; ?>
        <?php foreach ($publicPosts as $post): ?> 
            <?php if ($i % 3 === 0): ?>
            <?php endif; ?>
            <table class="post-table public-post">
                <tr class="post-date">
                    <td><?php echo $post['PostDate']; ?></td>
                </tr>
                <tr class="post-title">
                    <td><?php echo $post['Title']; ?> - <?php echo $post['Category']; ?></td>
                </tr>
            </table>
            <?php $i++; ?>
        <?php endforeach; ?>

        <?php foreach ($privatePosts as $post): ?> 
            <?php if ($i % 3 === 0): ?>
                <br/>
            <?php endif; ?>
            <table class="post-table private-post" style="display: none;">
                <tr class="post-date">
                    <td><?php echo $post['PostDate']; ?></td>
                </tr>
                <tr class="post-title">
                    <td><?php echo $post['Title']; ?> - <?php echo $post['Category']; ?></td>
                </tr>
            </table>
            <?php $i++; ?>
        <?php endforeach; ?>
    </div>

    <footer>
        <p id="footerCopyrightMsg">&copy; 2024 iBlogs. All rights reserved.</p>
        <p id="footerPhoneNum">778-123-4567</p>
        <p id="footerEmail">iblogs@blogger.com</p>
        <p>
            <img src="images/twitter (1).png" alt="Twitter" width="30">
            <img src="images/facebook.png" alt="Facebook" width="30">       
            <img src="images/insta.png" alt="Instagram" width="30">
        </p>
    </footer>

</body>

</html>

