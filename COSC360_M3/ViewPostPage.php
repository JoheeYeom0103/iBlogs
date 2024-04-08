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
            <li><a href="AccountPage.php" class="menu">@<?php echo $userId?></a></li>
            </ul>

        </nav>
    </header> 

    <div>
        <!-- <h2>Post</h2>
        <div class="post">
            <h3><?php echo $postTitle?></h3>
            <p><?php echo $postContent?></p>
        </div>
        <div class="commentSection">
            <h2>Comments</h2>
            <div class="comment">
                <h3>Commenter</h3>
                <p>Comment</p>
            </div> -->

            <form method="get" action="" id="mainForm">
            
    </div>

    <div>
        <?php include("php/viewPostAction.php");?>  
    </div>

</body>
</html>