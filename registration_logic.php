<?php
    include("site_logic.php");
    $login = $_POST['input_login'];
    $password = $_POST['input_pass'];
    $mail = $_POST['input_mail'];
    

    if(isset($login) && isset($password) && isset($mail) && !empty($login) && !empty($password) && !empty($mail))
    {
        $newuser = new user($login,$password,$mail);
        $newuser->create($login,$password,$mail);
    }
    else
    {
        echo "Error";
    }
?>