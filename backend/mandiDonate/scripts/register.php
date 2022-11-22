<?php
    include("config.php");
    session_start();
    $_POST = json_decode(file_get_contents('php://input'), true);

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $myusername = mysqli_real_escape_string($db,$_POST['username']);

        $sql = "SELECT username FROM donator WHERE username = '$myusername'";

        $result = mysqli_query($db,$sql);
        $count = mysqli_num_rows($result);
        
        // If result matched $myusername and $mypassword, table row must be 1 row
        if($count == 0) {
            $personname = mysqli_real_escape_string($db,$_POST['personname']);
            $emailid = mysqli_real_escape_string($db,$_POST['emailid']);
            $mypassword = mysqli_real_escape_string($db,$_POST['password']); 

            $sql = "SELECT emailid FROM donatordetails WHERE emailid = '$emailid'";
            $result = mysqli_query($db,$sql);
            $count = mysqli_num_rows($result);

            if($count == 1) {
                $jsonres = array(
                    "error" => 1,
                    "message" => "Email ID Already Registered."
                );
            }else {
                $sql = "INSERT INTO donator VALUES('$myusername', '$mypassword')";
                $result = mysqli_query($db,$sql);
                $sql = "INSERT INTO donatordetails VALUES('$myusername', '$personname', '$emailid')";
                $result = mysqli_query($db,$sql);

                $_SESSION['login_user'] = $myusername;
                $jsonres = array(
                    "error" => 0,
                    "message" => "User Registered Successfully."
                );
            }
        }else {
            $_SESSION['login_user'] = '';
            $jsonres = array(
                "error" => 1,
                "message" => "Username Already Registered."
            );
        }
    }else {
        $jsonres = array(
            "error" => 1,
            "message" => "Invalid Request."
        );
    };
    echo json_encode($jsonres);
?>