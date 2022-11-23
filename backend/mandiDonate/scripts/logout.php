<?php
    include("access.php");
    session_start();
    $_SESSION['login_user'] = "";
    $_SESSION['role'] = null;
    $jsonres = array(
    "error" => 0
    );
    echo json_encode($jsonres);
?>