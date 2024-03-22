<?php
include("php/dbConnect.php");

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