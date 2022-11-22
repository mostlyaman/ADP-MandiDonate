<?php
/*
Handles a new donation addition request. (Admin)

Input: {
    "name" : (Donation Item Name),
    "desc" : (Donation Item Description),
    "qty" : (Donation Item Quantity)
}

Returns: {
    "error" : (0 if success, 1 if error),
    "message" : (error message if error, success msg + DONATION ID otherwise)
}
*/
    include("config.php");
    include("access.php");
    session_start();

    if(!array_key_exists('login_user', $_SESSION)) $_SESSION['login_user'] = '';
    if(!array_key_exists('role', $_SESSION)) $_SESSION['role'] = '';
    $myusername = $_SESSION['login_user'];
    $role = $_SESSION['role'];

    if(($_SERVER["REQUEST_METHOD"] == "POST") and ($myusername)) {
        if($role == 'Admin'){
            $_POST = json_decode(file_get_contents('php://input'), true);
            $dName = $_POST['name'];
            $dDesc = $_POST['desc'];
            $dAdmin = $myusername;
            $dQty = $_POST['qty'];

            $sql = "INSERT INTO donations(`dName`, `dDesc`, `dAdmin`, `dTotal`) VALUES('$dName', '$dDesc', '$dAdmin', '$dQty')";
            $result = mysqli_query($db,$sql);
            $sql = "SELECT LAST_INSERT_ID() AS dID FROM donations;";
            $result = mysqli_query($db,$sql);
            $dID = mysqli_fetch_array($result,MYSQLI_ASSOC)['dID'];
            $jsonres = array(
                "error" => 0,
                "message" => "Donation Added Successfully! Donation ID: '$dID'"
                );
        }else if($role == 'User'){
            $error = "Permission Denied!";
            $jsonres = array(
                "error" => 1,
                "message" => $error
                );
        }else {
            $error = "No One Logged In";
            $jsonres = array(
                "error" => 1,
                "message" => $error
                );
        }
    }else {
        $error = "No One Logged In";
        $jsonres = array(
        "error" => 1,
        "message" => $error,
        );
    }
    echo json_encode($jsonres)
?>