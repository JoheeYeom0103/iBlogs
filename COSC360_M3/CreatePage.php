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
    <script src="script/createPage.js"></script>
    <?php include("php/createpageAction.php"); ?>
    <!-- Scripts -->

</head>

<body>

    <header>
        <h1>iBlogs</h1>
        <nav>
            <ul>
                <li><a href="#" class="menu">Log In</a></li>
                <li><a href="#" class="menu">Sign Up</a></li>
            </ul>

        </nav>
    </header> 

    <div class="diary-container">
        <form id="createPostForm" action="php/createpageAction.php" method="post">
        
            <div class="header">
            <h2>February 5, 2024</h2>
            <hr class="line">
            <img src="images/title.svg" class="title-icon"/>
            <p class="inputHint">Title: </p>
            <input type="text" name="title" class="inputLine">
            <span class="tooltip-title">
                <img src="images/helpIcon-01.svg" alt="Help Icon" class="help-icon">
                <span class="tooltip-message">Please write a caption title for your post.</span>
            </span>
            <br/>
            <img src="images/cateogry.svg" class="category-icon"/>
            <p class="inputHint">Category:</p>
            <select name="category" class="inputLine">
                <option value="" disabled selected>Select a category</option>
                <option value="Personal">Personal</option>
                <option value="Travel">Travel</option>
                <option value="Food">Food</option>
                <option value="Lifestyle">Lifestyle</option>
                <option value="Health">Health</option>
                <option value="Fitness">Fitness</option>
                <option value="Fashion">Fashion</option>
                <option value="Beauty">Beauty</option>
                <option value="Technology">Technology</option>
                <option value="Entertainment">Entertainment</option>
                <option value="Sports">Sports</option>
                <option value="Education">Education</option>
                <option value="Business">Business</option>
                <option value="Finance">Finance</option>
                <option value="Science">Science</option>
                <option value="Environment">Environment</option>
                <option value="Politics">Politics</option>
                <option value="Art">Art</option>
                <option value="Music">Music</option>
                <option value="Movies">Movies</option>
                <option value="Books">Books</option>
                <option value="Games">Games</option>
                <option value="Other">Other</option>
            </select>
            <span class="tooltip-category">
                <img src="images/helpIcon-01.svg" alt="Help Icon" class="help-icon">
                <span class="tooltip-message">Please select a category for your post.</span>
            </span>
        </div>
        <div class="content">
            <textarea class="diary-entry" name="diary-entry" placeholder="Share your experience and insights!"></textarea>
            <span class="tooltip-content">
                <img src="images/helpIcon-01.svg" alt="Help Icon" class="help-icon">
                <span class="tooltip-message"> Please write down your thoughts in the text box. </span>
            </span>
        </div>
        <div class="footer">
            
        <?php 
        if (isset($_SESSION['createPostErrors'])) {
            $errors = $_SESSION['createPostErrors'];
            foreach ($errors as $error) {
                echo "<p class='error'>$error</p>";
            }
        }
    ?>
            <button class="share-btn" name="publicPost"><span class="buttonText">Share with</span></button>
                <div class="share-options">
                <button class="buttonText" name="publicPost">Public</button>
                <button class="buttonText" name="privatePost">Private</button>
            </div>
            <span class="tooltip-share">
                <img src="images/helpIcon-01.svg" alt="Help Icon" class="help-icon">
                <span class="tooltip-message">Please hover over the "Share" button to select either "public" or "private" for your post.</span>
            </span>
        </div>
        
        </form>
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


   

