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
        <h2>Hello, Administrator @Username!</h2>
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
            <?php
                $host = "localhost";
                $database = "iblog";
                $user = "joy";
                $db_password = "joy5767";

                $connection = mysqli_connect($host, $user, $db_password, $database);

                $error = mysqli_connect_error();

                if ($error != null) {
                    $error_message = "Connection failed: " . mysqli_connect_error();
                    exit("<p>$error_message</p>");
                }

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
                        echo "<div class='usersOnPlatform'><table><tr><th>Username</th><th>Link to User History</th></tr>";

                        while ($row = mysqli_fetch_assoc($result)) {
                            $userId = $row['UserId'];
                            echo "<tr id='tableData'><td>" . $userId . "</td><td><a href='http://localhost/cosc360_editaccount/adminUserHistory.php'>View User History</a></td></tr>";
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
            ?>
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
