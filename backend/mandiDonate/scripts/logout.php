<?php
    session_start();
    $_SESSION['login_user'] = "";
    $jsonres = array(
    "error" => 0
    );
    echo json_encode($jsonres);
?>