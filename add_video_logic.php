<?php
    include("site_logic.php");
//echo $_POST['name'] . "///" . $_POST['desc'] . "///" . $_SESSION["newvideo"]['name'];
    //$check = video_worker::checkFile($_SESSION["newvideo"]);
     //video_worker::uploadFile($check,$_SESSION["newvideo"],$_POST['name'],$_POST['desc']);
    /*if($check && !empty($_POST['name']))
    {
        move_uploaded_file($_SESSION["newvideo"]["tmp_name"],"videos/" .$_SESSION["newvideo"]['name']);
    }*/
    $_SESSION["video_name"] = $_POST['name'];
    $_SESSION["video_desc"] = $_POST['desc'];
?>