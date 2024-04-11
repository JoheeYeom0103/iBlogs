<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Explore Page</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/exploreStyle.css" />
    <link rel="stylesheet" href="css/headerfooter.css" />
    <!-- Stylesheets -->

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Aboreto" rel="stylesheet" />

    <?php 
      include("php/logoutAction.php"); 
      include("php/exploreAction.php");
      include("php/searchExplore.php");
    ?>

  </head>

  <body>
    <header>
      <h1>iBlogs</h1>
      <nav>
        <ul>
          <?php if ($userId): ?>
            <li>
              <form action="php/logoutAction.php" method="post">
                <button class="logoutButton" type="submit" name="logout"> Log Out </button>
              </form>
            </li>
            <li><a href="AccountPage.php" class="menu">@<?php echo $userId?></a></li>
          <?php else: ?>
            <li><a href="loginPage.php" class="menu">Log In</a></li>
            <li><a href="signupPage.php" class="menu">Sign Up</a></li>
          <?php endif; ?>
        </ul>
      </nav>
    </header>

    <div class="mainSearch">
      <form class="searchForm" method="get">
        <label><img src="images/SearchIcon-01.png" alt="Search Icon" /></label>
        <input type="text" name="searchQuery" placeholder="food, lifestyle ..." />
        <button class="exploreSearchButton" type="submit">Search</button>
      </form>
      <?php if (isset($_GET["searchQuery"]) && !empty($_GET["searchQuery"])): ?>
        <a href="explore.php" class="backButton">Back to all search results</a>
      <?php endif; ?>
    </div>

    <section id="categorySection">
          <?php
        if ($interestImages) {
          foreach ($interestImages as $interest) {
              echo '<div class="category" data-title="' . $interest["interest_name"]. '">';
              echo '<div class="interestContainer"><img src="' . $interest["image_url"] . '" alt="' . $interest["interest_name"] . '" /></div>';
              echo '</div>';
          }
        }
        ?>
    </section>

    <section id="userPostSection">
    <!-- feed of user posts -->
      <div class="userPostColumn1">
      <?php
        if (!empty($searchResults)) {
            // Display search results if the user is searching
            foreach ($searchResults as $result) {
                echo '<div class="userPosts">';
                // Link to the individual post using post ID
                // TODO update URL with correct page name for post page
                echo '<h2><a id="postURL" href="post.php?id=' . $result["postId"] . '">' . $result["title"] . '</a></h2>';
                echo '<p><b>Category:</b> ' . $result["interest_name"] . '</p>';
                echo '<p>' . $result["content"] . '</p>';
                echo '</div>';
            }
        } else {
            // Display user's post feed if there is no query being made
            foreach ($postInfo as $post) {
                echo '<div class="userPosts">';
                // Link to the individual post using post ID
                // TODO update URL with correct page name for post page
                echo '<h2><a id="postURL" href="post.php?id=' . $post["postId"] . '">' . $post["title"] . '</a></h2>';
                echo '<p><b>Category:</b> ' . $post["interest_name"] . '</p>';
                echo '<p>' . $post["content"] . '</p>';
                echo '</div>';
            }
        }
        ?>
      </div>
    </section>

    <footer>
      <p id="footerCopyrightMsg">&copy; 2024 iBlogs. All rights reserved.</p>
      <p id="footerPhoneNum">778-123-4567</p>
      <p id="footerEmail">iblogs@blogger.com</p>
      <p>
        <img src="images/twitter.png" alt="Twitter" width="30" />
        <img src="images/facebook.png" alt="Facebook" width="30" />
        <img src="images/insta.png" alt="Instagram" width="30" />
      </p>
    </footer>
  </body>
</html>
