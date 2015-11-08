<?php
    include("site_logic.php");
    video_worker::uploadFile($_FILES['newvideo'],$_POST['name_video'],$_POST['desciption_video']);
?>