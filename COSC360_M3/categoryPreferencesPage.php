<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Category Preferences</title>
    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/categoryPage.css">
    <link rel="stylesheet" href="css/headerfooter.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Aboreto" rel="stylesheet">
    <!-- Stylesheets -->

    <!-- Scripts -->
    <script src="script/categorypreference.js"></script>
    <?php include("php/categoryPreferenceAction.php"); ?>
    <!-- Scripts -->

</head>
<body>
<header>
    <h1>iBlogs</h1>
</header>
<section>
    <div id="text">
        <p>Please Select 6 Category Preferences:</p>
    </div>
    <form id="categoryForm" method="post" action="php/categoryPreferenceAction.php">
        <div class="category-container">
            <div class="category-preferences1">
                <label for="technology-checkbox">Technology
                    <input id="technology-checkbox" class="category-checkbox" type="checkbox" name="categories[]" value="Technology">
                </label>

                <label for="travel-checkbox">Travel
                    <input id="travel-checkbox" class="category-checkbox" type="checkbox" name="categories[]" value="Travel">
                </label>

                <label for="food-checkbox">Food
                    <input id="food-checkbox" class="category-checkbox" type="checkbox" name="categories[]" value="Food">
                </label>

                <label for="health-checkbox">Health
                    <input id="health-checkbox" class="category-checkbox" type="checkbox" name="categories[]" value="Health">
                </label>

                <label for="entertainment-checkbox">Entertainment
                    <input id="entertainment-checkbox" class="category-checkbox" type="checkbox" name="categories[]" value="Entertainment">
                </label>

                <label for="politics-checkbox">Politics
                    <input id="politics-checkbox" class="category-checkbox" type="checkbox" name="categories[]" value="Politics">
                </label>

                <label for="architecture-checkbox">Architecture
                    <input id="architecture-checkbox" class="category-checkbox" type="checkbox" name="categories[]" value="Architecture">
                </label>

                <label for="nature-checkbox">Nature
                    <input id="nature-checkbox" class="category-checkbox" type="checkbox" name="categories[]" value="Nature">
                </label>

                <label for="animals-pets-checkbox">Animals & Pets
                    <input id="animals-pets-checkbox" class="category-checkbox" type="checkbox" name="categories[]" value="Animals & Pets">
                </label>

                <label for="sports-checkbox">Sports
                    <input id="sports-checkbox" class="category-checkbox" type="checkbox" name="categories[]" value="Sports">
                </label>

                <label for="cars-checkbox">Cars
                    <input id="cars-checkbox" class="category-checkbox" type="checkbox" name="categories[]" value="Cars">
                </label>

                <label for="footwear-checkbox">Footwear
                    <input id="footwear-checkbox" class="category-checkbox" type="checkbox" name="categories[]" value="Footwear">
                </label>

                <label for="science-checkbox">Science
                    <input id="science-checkbox" class="category-checkbox" type="checkbox" name="categories[]" value="Science">
                </label>

            </div>
            <div class="category-preferences2">
                <label for="art-checkbox">Art
                    <input id="art-checkbox" class="category-checkbox" type="checkbox" name="categories[]" value="Art">
                </label>

                <label for="fashion-checkbox">Fashion
                    <input id="fashion-checkbox" class="category-checkbox" type="checkbox" name="categories[]" value="Fashion">
                </label>

                <label for="beauty-checkbox">Beauty
                    <input id="beauty-checkbox" class="category-checkbox" type="checkbox" name="categories[]" value="Beauty">
                </label>

                <label for="diy-crafts-checkbox">DIY & Crafts
                    <input id="diy-crafts-checkbox" class="category-checkbox" type="checkbox" name="categories[]" value="DIY & Crafts">
                </label>

                <label for="home-decor-checkbox">Home Decor
                    <input id="home-decor-checkbox" class="category-checkbox" type="checkbox" name="categories[]" value="Home Decor">
                </label>

                <label for="film-checkbox">Film
                    <input id="film-checkbox" class="category-checkbox" type="checkbox" name="categories[]" value="Film">
                </label>

                <label for="music-checkbox">Music
                    <input id="music-checkbox" class="category-checkbox" type="checkbox" name="categories[]" value="Music">
                </label>

                <label for="books-checkbox">Books
                    <input id="books-checkbox" class="category-checkbox" type="checkbox" name="categories[]" value="Books">
                </label>

                <label for="education-checkbox">Education
                    <input id="education-checkbox" class="category-checkbox" type="checkbox" name="categories[]" value="Education">
                </label>

                <label for="funny-checkbox">Funny
                    <input id="funny-checkbox" class="category-checkbox" type="checkbox" name="categories[]" value="Funny">
                </label>

                <label for="business-checkbox">Business
                    <input id="business-checkbox" class="category-checkbox" type="checkbox" name="categories[]" value="Business">
                </label>

                <label for="holidays-checkbox">Holidays
                    <input id="holidays-checkbox" class="category-checkbox" type="checkbox" name="categories[]" value="Holidays">
                </label>

                <label for="other-checkbox">Other
                    <input id="other-checkbox" class="category-checkbox" type="checkbox" name="categories[]" value="Other">
                </label>

            </div>
        </div>
        <div class="done-button">
            <span id ="categoryCounter">Categories selected: </span>
            <button type="submit" class="done-button">Done</button>
        </div>
    </form>
</section>
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
