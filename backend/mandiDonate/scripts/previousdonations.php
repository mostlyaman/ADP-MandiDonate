<?php
/*
Returns data of all items available for donation.

Input: None

Sample Return: {
    "error": 0,
    "data": [
        {
            "id": "3",
            "user": "user1",
            "name": "N95 Masks",
            "desc": "N95 Masks to protect against virus",
            "qty": "25",
            "time": "2022-11-22 22:27:06"
        },
        {
            "id": "2",
            "user": "user1",
            "name": "N95 Masks",
            "desc": "N95 Masks to protect against virus",
            "qty": "25",
            "time": "2022-11-22 22:26:10"
        }
    ]
}
*/
    include("config.php");
    include("access.php");
    session_start();

    if(!array_key_exists('login_user', $_SESSION)) $_SESSION['login_user'] = '';
    if(!array_key_exists('role', $_SESSION)) $_SESSION['role'] = '';
    $myusername = $_SESSION['login_user'];
    $role = $_SESSION['role'];

    if(($myusername) and (($role == "Admin") or ($role == "User"))) {
        if($role == "Admin"){
            $sql = "SELECT transactions.tID AS tID, transactions.dUser as dUser, donations.dName AS dName, donations.dDesc AS dDesc, transactions.dQty AS dQty, transactions.tTime AS tTime FROM transactions LEFT JOIN donations ON transactions.dID = donations.dID ORDER BY tTime DESC;";
            $result = mysqli_query($db,$sql);
            $data = array();
            while($arr = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $t_row =  array(
                    'id' => $arr['tID'],
                    'user' => $arr['dUser'],
                    'name' => $arr['dName'],
                    'desc' => $arr['dDesc'],
                    'qty' => $arr['dQty'],
                    'time' => $arr['tTime']
                );
                array_push($data, $t_row);
            };
            $jsonres = array(
                "error" => 0,
                "data" => $data
                );
        }else if($role == "User"){
            $sql = "SELECT transactions.tID AS tID, transactions.dUser as dUser, donations.dName AS dName, donations.dDesc AS dDesc, transactions.dQty AS dQty, transactions.tTime AS tTime FROM transactions LEFT JOIN donations ON transactions.dID = donations.dID WHERE dUser = '$myusername' ORDER BY tTime DESC;";
            $result = mysqli_query($db,$sql);
            $data = array();
            while($arr = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $t_row =  array(
                    'id' => $arr['tID'],
                    'user' => $arr['dUser'],
                    'name' => $arr['dName'],
                    'desc' => $arr['dDesc'],
                    'qty' => $arr['dQty'],
                    'time' => $arr['tTime']
                );
                array_push($data, $t_row);
            };
            $jsonres = array(
                "error" => 0,
                "data" => $data
                );
        }

    }else {
        $error = "No One Logged In";
        $jsonres = array(
        "error" => 1,
        "data" => null,
        );
    }
    echo json_encode($jsonres)
?>