<?php

include("dbConnect.php");

if (isset($_GET["searchQuery"]) && !empty($_GET["searchQuery"])) {
    $searchQuery = $_GET["searchQuery"];
    $searchResults = searchPosts($searchQuery, $connection);
}

function searchPosts($searchQuery, $conn) {
    $sql = "SELECT post.Title, post.Content, interest.InterestName
            FROM post
            JOIN interest ON post.Category = interest.InterestName
            WHERE post.Title LIKE ? OR post.Content LIKE ? OR interest.InterestName LIKE ?";
    
    $stmt = mysqli_prepare($conn, $sql);
    $searchParam = "%$searchQuery%";
    mysqli_stmt_bind_param($stmt, "sss", $searchParam, $searchParam, $searchParam);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $searchResults = array();
    while ($row = mysqli_fetch_array($result)) {
        $searchResults[] = array(
            "title" => $row["Title"],
            "content" => $row["Content"],
            "interest_name" => $row["InterestName"]
        );
    }

    mysqli_stmt_close($stmt);
    return $searchResults;
}