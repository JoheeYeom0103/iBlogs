<?php 

    session_start();
    $userId = $_SESSION["userId"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Page</title>
    <!--CSS Files-->
    <link rel="stylesheet" href="css/headerfooter.css">
    <link rel="stylesheet" href="css/createStyling.css">
    <!--Font Files-->
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Aboreto' rel='stylesheet'>
    <!--Font Files-->

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script/addComments.js"></script>
    <script src="script/deleteComments.js"></script>
    <!-- Scripts -->

</head>

<body>

    <header>
        <h1>iBlogs</h1>
        <nav>
            <ul>
            <li>
              <form action="php/logoutAction.php" method="post">
                <button class="logoutButton" type="submit" name="logout"> Log Out </button>
              </form>
            </li>
            <li><a href="AccountPage.php" class="menu">@<?php echo $userId ?></a></li>
           
            </ul>

        </nav>
    </header> 

    <div>

            <form method="post" action="" id="mainForm">
                
                <?php include("php/viewPostAction.php");?>  
                
            </form>



            <?php if(isset($_SESSION['userId'])) : ?>
            <!-- Display comment form if user is logged in -->
            <form id="addCommentForm" action="php/commentAction.php" method="post" style="margin-top: 20px">
                <input type="hidden" name="postId" value="<?php echo $postId; ?>">
                <textarea name="commentContent" placeholder="Enter your comment here"></textarea>
                <button type="submit" name="addSubmit" style="display: block;">Add Comment</button>
            </form>

        <?php else : ?>
            <!-- Display a message to prompt the user to log in -->
            <p>Please log in to add comments.</p>
        <?php endif; ?>

        

        <!-- <form class='deleteForm' id='deleteForm" . $postRow['PostId'] . "' method='post' action='".$_SERVER["PHP_SELF"]."'>
            <input type='hidden' name='delete' value='" . $postRow['PostId'] . "'>
            <button type='submit' style='display: block; margin: 0 auto;'>Delete</button>
        </form> -->
    </div>

</body>
</html>