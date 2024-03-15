-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 09, 2017 at 08:05 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web_sample`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE Member (
    Username VARCHAR(50) PRIMARY KEY,
    FirstName VARCHAR(15),
    MiddleName VARCHAR(15),
    LastName VARCHAR(20),
    Email VARCHAR(300),
    Password VARCHAR(16)
);

CREATE TABLE User (
    UserId VARCHAR(20) PRIMARY KEY,
    MemberUsername VARCHAR(50),
 	ProfileImage BLOB,
    FOREIGN KEY (MemberUsername) REFERENCES Member(Username)
);

CREATE TABLE Interest (
    InterestId VARCHAR(20) PRIMARY KEY,
    InterestName VARCHAR(50)
);

CREATE TABLE UserInterest (
    UserId VARCHAR(20),
    InterestId VARCHAR(20),
    PRIMARY KEY (UserId, InterestId),
    FOREIGN KEY (UserId) REFERENCES User(UserId),
    FOREIGN KEY (InterestId) REFERENCES Interest(InterestId)
);

CREATE TABLE Administrator (
    AdminId VARCHAR(20) PRIMARY KEY,
    MemberUsername VARCHAR(50),
    FOREIGN KEY (MemberUsername) REFERENCES Member(Username)
);

CREATE TABLE Administration (
    UserId VARCHAR(20),
    AdminId VARCHAR(20),
    PRIMARY KEY (UserId, AdminId),
    FOREIGN KEY (UserId) REFERENCES User(UserId),
    FOREIGN KEY (AdminId) REFERENCES Administrator(AdminId)
);

CREATE TABLE Post (
    PostId INT AUTO_INCREMENT PRIMARY KEY,
    DateOfPost DATETIME,
    UserId VARCHAR(20),
    Title VARCHAR(30),
    Category VARCHAR(50),
    Content TEXT, 
    ShareOption ENUM('Private', 'Public'),
    FOREIGN KEY (UserId) REFERENCES User(UserId)
);

CREATE TABLE Comment (
    CommentId INT AUTO_INCREMENT PRIMARY KEY,
    PostId INT,
    UserId VARCHAR(20),
    DateOfComment DATETIME,
    Content VARCHAR(500),
    FOREIGN KEY (PostId) REFERENCES Post(PostId),
    FOREIGN KEY (UserId) REFERENCES User(UserId)
);

-- Sample data for Member table
INSERT INTO Member (Username, FirstName, MiddleName, LastName, Email, Password) 
VALUES 
('john_doe', 'John', 'Smith', 'Doe', 'john.doe@example.com', 'password123'),
('jane_smith', 'Jane', NULL, 'Smith', 'jane.smith@example.com', 'securepassword');

-- Sample data for User table
INSERT INTO User (UserId, MemberUsername, ProfileImage) 
VALUES 
('user_1', 'john_doe', NULL),
('user_2', 'jane_smith', NULL);

-- Sample data for Interest table
INSERT INTO Interest (InterestId, InterestName) 
VALUES 
('interest_1', 'Programming'),
('interest_2', 'Cooking');

-- Sample data for UserInterest table
INSERT INTO UserInterest (UserId, InterestId) 
VALUES 
('user_1', 'interest_1'),
('user_1', 'interest_2'),
('user_2', 'interest_2');

-- Sample data for Administrator table
INSERT INTO Administrator (AdminId, MemberUsername) 
VALUES 
('admin_1', 'john_doe'),
('admin_2', 'jane_smith');

-- Sample data for Administration table
INSERT INTO Administration (UserId, AdminId) 
VALUES 
('user_1', 'admin_1'),
('user_2', 'admin_2');

-- Sample data for Post table
INSERT INTO Post (DateOfPost, UserId, Title, Category, Content, ShareOption) 
VALUES 
('2024-03-14 12:00:00', 'user_1', 'Introduction to Programming', 'Technology', 'This is a post about programming.', 'Public'),
('2024-03-14 13:00:00', 'user_2', 'Delicious Recipes', 'Food', 'Sharing my favorite recipes with you all.', 'Public');

-- Sample data for Comment table
INSERT INTO Comment (PostId, UserId, DateOfComment, Content) 
VALUES 
(1, 'user_2', '2024-03-14 12:30:00', 'Great post, John!'),
(2, 'user_1', '2024-03-14 13:30:00', 'I love these recipes, Jane!');


