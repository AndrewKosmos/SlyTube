<?php
    include("site_logic.php");
    $_SESSION["curr_video"] = $_POST['v_name'];
    print_r($_SESSION["curr_video"]);
?>