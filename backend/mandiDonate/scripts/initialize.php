<?php
    include("config.php");
    session_start();
    $sql = "CREATE TABLE IF NOT EXISTS donator (username VARCHAR(20) PRIMARY KEY, secretpass VARCHAR(100));";
    $result = mysqli_query($db,$sql);
    $sql = "CREATE TABLE IF NOT EXISTS donatordetails (username VARCHAR(20) PRIMARY KEY, personname VARCHAR(100), emailid VARCHAR(100));";
    $result = mysqli_query($db,$sql);
    $sql = "CREATE TABLE IF NOT EXISTS admins (username VARCHAR(20) PRIMARY KEY, secretpass VARCHAR(100));";
    $result = mysqli_query($db,$sql);
    $sql = "CREATE TABLE IF NOT EXISTS admindetails (username VARCHAR(20) PRIMARY KEY, personname VARCHAR(100), emailid VARCHAR(100));";
    $result = mysqli_query($db,$sql);
    $sql = "CREATE TABLE IF NOT EXISTS donations (dID INT PRIMARY KEY AUTO_INCREMENT, dName VARCHAR(100) NOT NULL, dDesc VARCHAR(1000) NOT NULL, dAdmin VARCHAR(20) NOT NULL, dTotal INT NOT NULL, dQty INT DEFAULT 0, dStatus BOOLEAN DEFAULT 0, dTime DATETIME DEFAULT CURRENT_TIMESTAMP);";
    $result = mysqli_query($db,$sql);
    $sql = "ALTER TABLE donations AUTO_INCREMENT=1;";
    $result = mysqli_query($db,$sql);
    $sql = "CREATE TABLE IF NOT EXISTS transactions (tID INT PRIMARY KEY AUTO_INCREMENT, dID INT NOT NULL, dUser VARCHAR(20) NOT NULL, dQty INT NOT NULL, tTime DATETIME DEFAULT CURRENT_TIMESTAMP);";
    $result = mysqli_query($db,$sql);
    $sql = "ALTER TABLE transactions AUTO_INCREMENT=1;";
    $result = mysqli_query($db,$sql);
?>