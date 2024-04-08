<?php

// begin session
session_start();
include("dbConnectZ.php");

// set the userID based on the session userID attained from logging in/signing up
if (isset($_SESSION["userId"])){
 $userId = $_SESSION["userId"];

 $interestImages = getUserInterests($userId, $connection);
 $postInfo = getUserPosts($userId, $connection);
}else{
    // if the user did not log in or sign up and logged in as a guest, then set the userId to null
   $userId = null;
   $interestImages = getUserInterests($userId, $connection);
   $postInfo = getUserPosts($userId, $connection);
}

function getUserPosts($userId, $conn){
    // retrieve posts based on the user's interests by querying the DB
    if ($userId !== null) {
        $sql = "SELECT post.Title, post.Content, interest.InterestName
                FROM post
                JOIN interest ON post.Category = interest.InterestName
                JOIN userinterest ON interest.InterestId = userinterest.InterestId
                WHERE userinterest.UserId = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    } else {
        // Default query if user is a guest
        $sql = "SELECT post.Title, post.Content, interest.InterestName
                FROM post
                JOIN interest ON post.Category = interest.InterestName
                LIMIT 6";
        $result = mysqli_query($conn, $sql);
    }

    if ($result){
        $userPosts = array();
        // store the retrieved post information in an array 
        while($row = mysqli_fetch_array($result)){
            $userPosts[] = array(
                "title" => $row["Title"],
                "content" => $row["Content"],
                "interest_name" => $row["InterestName"]
            );
        }
        // Free the result set
        mysqli_free_result($result);
        // Close the statement
        if (isset($stmt)) {
            mysqli_stmt_close($stmt);
        }
        return $userPosts;
    } else {
        // Close the statement if it was opened
        if (isset($stmt)) {
            mysqli_stmt_close($stmt);
        }
        return null;
    }
}




function getUserInterests($userId, $conn){
    // if the user is logged in query the DB for their preferred categories 
    // and get the image url associated with them to display on the explore page
    if ($userId !== null) {
        $sql = "SELECT interest.image_url, interest.InterestName
                FROM userinterest
                JOIN interest ON userinterest.InterestId = interest.InterestId
                WHERE userinterest.UserId = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $userId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    } else {
        // if the user is not logged in, e.g.  a guest, then grab the first 6 categories from
        // the DB and do the same as above. 
        $sql = "SELECT * FROM interest LIMIT 6";
        $result = mysqli_query($conn, $sql);
    }

    if ($result){
        // store the results of the query in an array to be accessed on the explore page
        $interestImages = array();
        while($row = mysqli_fetch_array($result)){
            $interestImages[] = array(
                "image_url" => $row["image_url"],
                "interest_name" => $row["InterestName"]
            );
        }
        
        // Close the result set
        mysqli_free_result($result);

        // Close the statement if it was used
        if (isset($stmt)) {
            mysqli_stmt_close($stmt);
        }

        return $interestImages;
    } else {
        // Close the statement if it was used
        if (isset($stmt)) {
            mysqli_stmt_close($stmt);
        }
        return null;
    }
}



