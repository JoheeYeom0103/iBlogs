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

    <link
      href="https://fonts.googleapis.com/css?family=Montserrat"
      rel="stylesheet"
    />
    <link
      href="https://fonts.googleapis.com/css?family=Aboreto"
      rel="stylesheet"
    />
  </head>

  <body>
    <header>
      <h1>iBlogs</h1>
      <nav>
        <ul>
          <li><a href="loginPage.html" class="menu">Log In</a></li>
          <li><a href="signupPage.html" class="menu">Sign Up</a></li>
        </ul>
      </nav>
    </header>

    <div class="mainSearch">
      <label><img src="images/SearchIcon-01.png" alt="Search Icon" /></label>
      <input type="text" placeholder="#food, #lifestyle #..." />
    </div>

    <section id="categorySection">
      <!-- Sample categories, replace these with actual categories -->
      <div class="category">
        <img src="https://placehold.co/200x150" alt="Sample Image 1" />
      </div>
      <div class="category">
        <img src="https://placehold.co/200x150" alt="Sample Image 1" />
      </div>
      <div class="category">
        <img src="https://placehold.co/200x150" alt="Sample Image 1" />
      </div>
      <div class="category">
        <img src="https://placehold.co/200x150" alt="Sample Image 1" />
      </div>
      <div class="category">
        <img src="https://placehold.co/200x150" alt="Sample Image 1" />
      </div>
      <div class="category">
        <img src="https://placehold.co/200x150" alt="Sample Image 1" />
      </div>
    </section>

    <section id="userPostSection">
      <!-- feed of user posts -->
      <div class="userPostColumn1">
        <div class="userPosts">
          <img src="https://placehold.co/500x150" alt="Sample Image 1" />
        </div>
        <div class="userPosts">
          <img src="https://placehold.co/500x150" alt="Sample Image 2" />
        </div>
        <div class="userPosts">
          <img src="https://placehold.co/500x150" alt="Sample Image 3" />
        </div>
      </div>

      <div class="userPostColumn2">
        <div class="userPosts">
          <img src="https://placehold.co/500x150" alt="Sample Image 4" />
        </div>
        <div class="userPosts">
          <img src="https://placehold.co/500x150" alt="Sample Image 5" />
        </div>
        <div class="userPosts">
          <img src="https://placehold.co/500x150" alt="Sample Image 6" />
        </div>
      </div>
    </section>

    <footer>
      <p id="footerCopyrightMsg">&copy; 2024 iBlogs. All rights reserved.</p>
      <p id="footerPhoneNum">778-123-4567</p>
      <p id="footerEmail">iblogs@blogger.com</p>
      <p>
        <img src="images/twitter (1).png" alt="Twitter" width="30" />
        <img src="images/facebook.png" alt="Facebook" width="30" />
        <img src="images/insta.png" alt="Instagram" width="30" />
      </p>
    </footer>
  </body>
</html>