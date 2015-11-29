<?php
        include("header.php");
        include("sidebar.php");
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SlyTube - watching</title>
    <link rel="icon" href="favicon2.png" type="image/png">
    <link rel="stylesheet" href="stylesheets/style.css">
    <link rel="stylesheet" href="js/video-js.min.css">
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/video.js"></script>
</head>
<body>
    <?php  $adr = "videos/" .$_SESSION["curr_video"] . ".mp4";  ?>
    <div class="cont" id="mainContent">
        <div class="video_block">
            <div class="video">
                <video id="my-video" class="video-js vjs-default-skin vjs-big-play-centered" controls preload="auto" width="640" height="264"
                  poster="favicon.png" data-setup="{}">
                <source src="<?php echo $adr;?>" type='video/mp4'>
                <p class="vjs-no-js">
                  To view this video please enable JavaScript, and consider upgrading to a web browser that
                  <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                </p>
                </video>
            </div>
            <div class="info">
                <p id="p_v_name"><?php echo $_SESSION["curr_video"]; ?></p>
                <button class="add_button">+</button>
            </div>
        </div>
        <div class="t_spans_block"></div>
    </div>
    
    
    <?php  include("footer.php");  ?>
    
    <script>
        $(".add_button").mouseenter(function(){
            $(this).text("Add timespan");
            $(this).css('white-space','nowrap');
            $(this).css('overflow','hidden');
        }).mouseleave(function(){
            $(this).text("+");
        });
    </script>
</body>
</html>