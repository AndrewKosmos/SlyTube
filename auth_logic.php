<?php
    include("site_logic.php");
    $login = $_POST['log_name'];
    $password = $_POST['log_pass'];
    $checkbox_result = verify_one_checkbox('remember');

    $newuser = new user($login,$password);
    $newuser->Authorization($login,$password,$checkbox_result);
?>
