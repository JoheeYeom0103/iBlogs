<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    include('php/dbConnectZ.php');

    session_start();
    $userId = $_SESSION['userId'];
    $profileImg = ''; 
  
    // Retrieve image from database
    $imgSql = "SELECT ProfileImg FROM user WHERE UserId = ?";
    $imgPstmt = mysqli_prepare($connection, $imgSql);

    if ($imgPstmt) {
        mysqli_stmt_bind_param($imgPstmt, "s", $userId);

        mysqli_stmt_execute($imgPstmt);

        mysqli_stmt_bind_result($imgPstmt, $profileImg);

        mysqli_stmt_fetch($imgPstmt);

        mysqli_stmt_close($imgPstmt);
    }

    // Retrieve posts from database
    $postSql = "SELECT PostID, Date(DateOfPost), Title, Category, ShareOption FROM post WHERE UserId = ?";
    $postPstmt = mysqli_prepare($connection, $postSql);

    if ($postPstmt) {
        
        mysqli_stmt_bind_param($postPstmt, "s", $userId);

        mysqli_stmt_execute($postPstmt);

        mysqli_stmt_bind_result($postPstmt, $postId, $postDate, $title, $category, $shareOption);

        // Check the share option and assign each data to an appropriate array
        $publicPosts = [];
        $privatePosts = [];

        while (mysqli_stmt_fetch($postPstmt)) {
            if ($shareOption === 'Public') {
                $publicPosts[] = [
                    'PostId' => $postId,
                    'PostDate' => $postDate,
                    'Title' => $title,
                    'Category' => $category
                ];
            } else {
                $privatePosts[] = [
                    'PostId' => $postId,
                    'PostDate' => $postDate,
                    'Title' => $title,
                    'Category' => $category
                ];
            }
        }

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
                <li>
                    <form action="php/logoutAction.php" method="post">
                        <button class="logoutButton" type="submit" name="logout">Log Out</button>
                    </form>
                </li>
                <li><a href="#" class="menu">@<?php echo $userId ?></a></li>
            </ul>
        </nav>
    </header> 

    <div class="user-profile">  
        <img src="<?php echo $profileImg !== '' ? 'uploads/' . $profileImg : 'images/userIcon.svg'; ?>" alt="User Icon" class="circular">
        <p><?php echo $userId ?></p>
        <div class="button-container">
            <a href="EditAccountPage.php"><button class="round-button">Edit Account</button></a>
            <a href="CreatePage.php"><button class="round-button">Create Post</button></a>
        </div>
        <div class="link-container">
            <a href="#" id="viewPublic" class="view-link" onclick="showPublicPosts()">Public</a>
            <span id="verticalBar"> | </span>
            <a href="#" id="viewPrivate" class="view-link" onclick="showPrivatePosts()">Private</a>
            <hr />
        </div>
    </div>

    <div class="user-post">
        <?php $i = 0; ?>

        <!-- Public Posts -->
        <!-- Iterate each post in the post array -->
        <?php foreach ($publicPosts as $post): ?> 
            <!-- <?php if ($i % 3 === 0): ?> -->
            <?php endif; ?>
            <!-- TODO: Change the link -->
            <a id='postURL' href='ViewPostPage.php?id=<?php echo $post['PostId'];?>'>
                <table class="post-table public-post">
                    <tr class="post-date">
                        <td colspan="2"><?php echo $post['PostDate']; ?></td>
                    </tr>
                    <tr class="post-title">
                        <td><?php echo $post['Category']; ?></td>
                        <td><?php echo $post['Title']; ?></td> 
                    </tr>
                </table>
            </a>
            <!-- <?php $i++; ?> -->
        <?php endforeach; ?>

        <!-- Private Posts -->
        <!-- Iterate each post in the post array -->
        <?php foreach ($privatePosts as $post): ?> 
            <?php if ($i % 3 === 0): ?>
                <br/>
            <?php endif; ?>
            <!-- TODO: Change the link -->
            <a id='postURL' href='post.php?id=<?php echo $post['PostId'];?>'>
                <table class="post-table private-post" style="display: none;">
                    <tr class="post-date">
                        <!-- Specify col-span in the td, not tr! -->
                        <td colspan="2"><?php echo $post['PostDate']; ?></td>
                    </tr>
                    <tr class="post-title">
                        <td><?php echo $post['Category']; ?></td>
                        <td><?php echo $post['Title']; ?></td> 
                    </tr>
                </table>
            </a>
            <?php $i++; ?>
        <?php endforeach; ?>
    </div>

    <footer>
        <p id="footerCopyrightMsg">&copy; 2024 iBlogs. All rights reserved.</p>
        <p id="footerPhoneNum">778-123-4567</p>
        <p id="footerEmail">iblogs@blogger.com</p>
        <p>
            <img src="images/twitter.png" alt="Twitter" width="30">
            <img src="images/facebook.png" alt="Facebook" width="30">       
            <img src="images/insta.png" alt="Instagram" width="30">
        </p>
    </footer>

</body>

</html>
