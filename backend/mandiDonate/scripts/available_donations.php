<?php
/*
Returns data of all items available for donation.

Input: None

Sample Return: {
    "error": 0,
    "data": [
        {
            "id": "3",
            "name": "N95 Masks",
            "desc": "N95 Masks to protect against virus",
            "qty": 50
        },
        {
            "id": "2",
            "name": "N95 Masks",
            "desc": "N95 Masks to protect against virus",
            "qty": 50
        },
        {
            "id": "1",
            "name": "N95 Masks",
            "desc": "N95 Masks to protect against virus",
            "qty": 50
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

    if($myusername) {
        $sql = "SELECT * FROM donations WHERE dStatus = 0 ORDER BY dTime DESC;";
        $result = mysqli_query($db, $sql);
        $data = array();
        while($arr = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $t_row =  array(
                'id' => $arr['dID'],
                'name' => $arr['dName'],
                'desc' => $arr['dDesc'],
                'qty' => ($arr['dTotal'] - $arr['dQty'])
            );
            array_push($data, $t_row);
        };
        $jsonres = array(
            "error" => 0,
            "data" => $data
            );

    }else {
        $error = "No One Logged In";
        $jsonres = array(
        "error" => 1,
        "data" => null,
        );
    }
    echo json_encode($jsonres)
?>