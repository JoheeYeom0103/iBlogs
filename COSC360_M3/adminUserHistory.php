<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Main page</title>
    
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/adminUserHistory.css">
    <link rel="stylesheet" href="css/headerfooter.css">
    <!-- Stylesheets -->

    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Aboreto' rel='stylesheet'>
</head>
<body>

    <header>
        <h1>iBlogs</h1>
        <nav>
            <ul>
                <li><a href="#" class="menu">@Username</a></li>
                <li><a href="#" class="menu">Sign Out</a></li>
            </ul>
        </nav>
    </header>

    <div class="greeting">
        <h2>User History of, @Username</h2>
    </div>

    <div class="usersContentHistory">
        <table>
            <tr><th>Content Type</th><th>Date/Time</th><th>Content Link</th></tr>
            <tr id="tableData"><td>Post</td><td>MM/DD/YYYY</td><td>URL To Post</td></tr>
            <tr id="tableData"><td>Post</td><td>MM/DD/YYYY</td><td>URL To Post</td></tr>
            <tr id="tableData"><td>Comment</td><td>MM/DD/YYYY</td><td>URL To Comment</td></tr>
            <tr id="tableData"><td>Post</td><td>MM/DD/YYYY</td><td>URL To Post</td></tr>
            <tr id="tableData"><td>Comment</td><td>MM/DD/YYYY</td><td>URL To Comment</td></tr>
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