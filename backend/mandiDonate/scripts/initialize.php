<?php
    include("config.php");
    session_start();
    $sql = "CREATE TABLE donator (username VARCHAR(20) PRIMARY KEY, secretpass VARCHAR(100));";
    $result = mysqli_query($db,$sql);
    $sql = "CREATE TABLE donatordetails (username VARCHAR(20) PRIMARY KEY, personname VARCHAR(100), emailid VARCHAR(100));";
    $result = mysqli_query($db,$sql);
    $sql = "CREATE TABLE admins (username VARCHAR(20) PRIMARY KEY, secretpass VARCHAR(100));";
    $result = mysqli_query($db,$sql);
    $sql = "CREATE TABLE admindetails (username VARCHAR(20) PRIMARY KEY, personname VARCHAR(100), emailid VARCHAR(100));";
    $result = mysqli_query($db,$sql);
?>