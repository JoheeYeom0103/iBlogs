<?php

require("dbConnect.php");

session_start();

$userId = $_SESSION['userId']; // Get user id from session
// $userId = "bob_jackson"; // Hardcoded user id for testing

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $title = $_POST['title'];
    $category = $_POST['category'];
    $diaryEntry = $_POST['diary-entry'];
    $is_publicPost = isset($_POST['publicPost']) ? 1 : 0; // Use ternary operator to set value
    $is_privatePost = isset($_POST['privatePost']) ? 1 : 0; // Use ternary operator to set value
    // $user_id = $_SESSION['user_id'];
    $current_time = date('Y-m-d H:i:s', time());

    $shareOption = "";
    if($is_privatePost == 1) {
        $shareOption = "Private";
    } else {
        $shareOption = "Public";
    }


    $errors = validateCreatePost($title, $category, $diaryEntry);

    if (empty($errors)) {
        $insertSql = "INSERT INTO post (UserId, Title, Category, Content, ShareOption, DateOfPost) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connection, $insertSql);
        mysqli_stmt_bind_param($stmt, "ssssss", $userId, $title, $category, $diaryEntry, $shareOption, $current_time);
        mysqli_stmt_execute($stmt);
        echo "<p> Post created successfully! </p>";

        header("Location: ../AccountPage.php");
        mysqli_stmt_close($stmt);
        exit(); // Add exit() after header redirect
    } else {
        echo "<p> Post creation failed! </p>";
        $_SESSION['createPostErrors'] = $errors;
        header("Location: ../CreatePage.php");
        exit(); // Add exit() after header redirect
    }
}

mysqli_close($connection);

function validateCreatePost($title, $category, $diaryEntry) {
    $errors = array();

    if (empty($title)) {
        array_push($errors, "Title is empty");
    }
    if (empty($category)) {
        array_push($errors, "Please Select a Category");
    }
    if (empty($diaryEntry)) {
        array_push($errors, "Diary Entry is empty");
    }

    return $errors;
}


