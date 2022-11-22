<?php
    include("config.php");
    session_start();
    $myusername = $_SESSION['login_user'];
    if($myusername) {
        $sql = "SELECT personname FROM donatordetails WHERE username = '$myusername'";
        $result = mysqli_query($db,$sql);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        $currentUser = $row['personname'];
        $jsonres = array(
        "error" => 0,
        "name" => $currentUser
        );
        echo json_encode($jsonres);
    }else {
        $error = "No One Logged In";
        $jsonres = array(
        "error" => 1,
        "name" => $error
        );
        echo json_encode($jsonres);
    }
?>