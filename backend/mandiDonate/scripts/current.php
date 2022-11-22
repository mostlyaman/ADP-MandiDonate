<?php
    include("config.php");
    session_start();
    if(!array_key_exists('login_user', $_SESSION)) $_SESSION['login_user'] = '';
    if(!array_key_exists('role', $_SESSION)) $_SESSION['role'] = '';
    $myusername = $_SESSION['login_user'];
    $role = $_SESSION['role'];
    if($myusername) {
        if($role == 'User'){
            $sql = "SELECT personname FROM donatordetails WHERE username = '$myusername'";
            $result = mysqli_query($db,$sql);
            $currentUser = mysqli_fetch_array($result,MYSQLI_ASSOC)['personname'];
            $jsonres = array(
                "error" => 0,
                "name" => $currentUser,
                "role" => $role
                );
        }else if($role == 'Admin'){
            $sql = "SELECT personname FROM admindetails WHERE username = '$myusername'";
            $result = mysqli_query($db,$sql);
            $currentUser = mysqli_fetch_array($result,MYSQLI_ASSOC)['personname'];
            $jsonres = array(
                "error" => 0,
                "name" => $currentUser,
                "role" => $role
                );
        }else {
            $error = "No One Logged In";
            $jsonres = array(
                "error" => 1,
                "name" => $error,
                "role" => null
                );
        }
    }else {
        $error = "No One Logged In";
        $jsonres = array(
        "error" => 1,
        "name" => $error,
        "role" => null
        );
    }
    echo json_encode($jsonres)
?>