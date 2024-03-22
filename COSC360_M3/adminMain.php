<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Main page</title>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/adminMain.css">
    <link rel="stylesheet" href="css/headerfooter.css">
    <!-- Stylesheets -->

    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Aboreto' rel='stylesheet'>

    <script src="script/adminMainDelete.js"></script>
    <?php include("php/logoutAction.php"); ?>

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

    <div class="greeting">
        <h2>Hello, Administrator @<?php echo $userId ?> </h2>
    </div>
    <form method="post" action="" id="mainForm">
        <div class="mainSearch">
            <label><img src="images/SearchIcon-01.png" alt="Search Icon"></label>
            <input type="text" name="search" placeholder="Search user history by username">
        
        </div>
    </form>

    <br>

    <div class="usersOnPlatform">
        <table>            
            <?php include("php/adminDisplayUsers.php");?>
        </table>
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
