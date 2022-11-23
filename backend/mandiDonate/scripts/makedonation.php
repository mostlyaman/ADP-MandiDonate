<?php
/*
Handles a new donation transaction request. (User)

Input: {
    "id" : (Donation Item ID),
    "qty" : (Donation Item Quantity)
}

Returns: {
    "error" : (0 if success, 1 if error),
    "message" : (error message if error, TRANSACTION ID otherwise)
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
        if($role == 'User'){
            $_POST = json_decode(file_get_contents('php://input'), true);
            $dID = (int)$_POST['id'];
            $dQty = (int)$_POST['qty'];
            $dUser = $myusername;

            $sql = "SELECT (dTotal-dQty) AS dAval, dStatus FROM donations WHERE dID = $dID;";
            $result = mysqli_query($db,$sql);
            $dAval = mysqli_fetch_array($result,MYSQLI_ASSOC)['dAval'];
            $dAval = (int)$dAval;
            if($dAval >= $dQty){
                $sql = "UPDATE donations SET dQty = (dQty+$dQty) WHERE dID = $dID;";
                $result = mysqli_query($db,$sql);
                if($dAval == $dQty){
                    $sql = "UPDATE donations SET dStatus = 1 WHERE dID = $dID;";
                    $result = mysqli_query($db,$sql);
                }
                $sql = "INSERT INTO transactions(`dID`, `dUser`, `dQty`) VALUES($dID, '$myusername', '$dQty');";
                $result = mysqli_query($db,$sql);
                $sql = "SELECT LAST_INSERT_ID() AS dID FROM donations;";
                $result = mysqli_query($db,$sql);
                $dID = mysqli_fetch_array($result,MYSQLI_ASSOC)['dID'];
                $jsonres = array(
                    "error" => 0,
                    "message" => $dID
                    );

            }else {
                $error = "Invalid Donation Quantity!";
                $jsonres = array(
                    "error" => 1,
                    "message" => $error
                    );
            }
        }else if($role == 'Admin'){
            $error = "Action not permitted!";
            $jsonres = array(
                "error" => 1,
                "message" => $error
                );
        }else {
            $error = "No One Logged In";
            $jsonres = array(
                "error" => 1,
                "message" => $error,
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