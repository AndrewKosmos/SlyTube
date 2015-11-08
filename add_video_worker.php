<?php
    print_r($_FILES);
    include("site_logic.php");
    /*$blacklist = array(".php","html",".php3",".php4",".htm",".mp3");
    foreach($blacklist as $item)
    {
        if(preg_match("/$item\$/i", $_FILES['newvideo']['name'])) exit;
    }
    $filetype = $_FILES['newvideo']['type'];
    $size = $_FILES['newvideo']['size'];*/
    /*if($filetype != "video/mp4") exit;
    if($size > 104857600) exit;*/
    video_worker::checkFile($_FILES['newvideo']);
?>