<?php
   include("config.php");
   session_start();
   $_POST = json_decode(file_get_contents('php://input'), true);
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form
      $myusername = mysqli_real_escape_string($db,$_POST['username']);
      $mypassword = mysqli_real_escape_string($db,$_POST['password']);
      $role = mysqli_real_escape_string($db,$_POST['role']);
      
      if($role == "User"){
         $sql = "SELECT username FROM donator WHERE username = '$myusername' and secretpass = '$mypassword'";
         $result = mysqli_query($db,$sql);
         $count = mysqli_num_rows($result);
         
         // If result matched $myusername and $mypassword, table row must be 1 row
         if($count == 1) {
            $_SESSION['login_user'] = $myusername;
            $_SESSION['role'] = "User";
            $jsonres = array(
               "error" => 0
            );
         }else {
            $_SESSION['login_user'] = '';
            $_SESSION['role'] = null;
            $jsonres = array(
               "error" => 1
            );
         }
      }else if($role == "Admin"){
         $sql = "SELECT username FROM admins WHERE username = '$myusername' and secretpass = '$mypassword'";
         $result = mysqli_query($db,$sql);
         $count = mysqli_num_rows($result);
         
         // If result matched $myusername and $mypassword, table row must be 1 row
         if($count == 1) {
            $_SESSION['login_user'] = $myusername;
            $_SESSION['role'] = "Admin";
            $jsonres = array(
               "error" => 0
            );
         }else {
            $_SESSION['login_user'] = '';
            $_SESSION['role'] = null;
            $jsonres = array(
               "error" => 1
            );
         }
      }else {
         $_SESSION['login_user'] = '';
         $_SESSION['role'] = null;
         $jsonres = array(
            "error" => 1
         );
      }
      echo json_encode($jsonres);
   }
?>