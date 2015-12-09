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
    <link rel="stylesheet" href="js/videojs.markers.css">
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/video.js"></script>
        <script src="js/videojs-markers.js"></script>
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
                <div class="show_break">
                <div class="av_mes"></div>
                <p></p>
            </div>
                </video>
            </div>
            <div class="info">
                <p id="p_v_name"><?php echo $_SESSION["curr_video"]; ?></p>
                <button class="add_button" id="show_block_add">+</button>
                <div class="add_timespan">
                    <textarea id="timespan_text" rows="2"></textarea>
                    <button class="add_button" id="add_text_timestamp">Add</button>
                </div>
            </div>
        </div>
        <!--<div class="show_break">
                <div class="av_mes"></div>
                <p></p>
            </div>-->
        <div class="t_spans_block">
            <?php
                $DB = connectDB();
                $query = "select ID from videos where Name='".$_SESSION['curr_video']."'";
                $q = $DB->prepare($query);
                $q->execute();
                $row = $q->fetch();
                $id = $row["ID"];
                $qq = "select Login,text,time from timespans join users on timespans.IDUser = users.ID where IDVideo = :id";
                $q = $DB->prepare($qq);
                $q->execute(array(':id' => $id));
                while($row = $q->fetch(PDO::FETCH_ASSOC))
                {
                    ?>
                        <div class="timespan_link_div">
                            <p id="timespan_user"><?php echo $row['Login'] ?></p>
                            <p id="timespan_link_time"><?php echo $row['time'] ?></p>
                            <p id="timespan_link_text"><?php echo $row['text'] ?></p>
                        </div>
                    <?php
                        
                }
            ?>
        </div>
    </div>


    <?php  include("footer.php");  ?>

    <script>
        var myPlayer = videojs('my-video');
        var mass_posts = $(".timespan_link_div");
        var mas = [];
        for(var i=0;i<mass_posts.length;i++)
            {
                //alert($(mass_posts[i]).find("#timespan_link_time").text());
                mas[i] = {time: $(mass_posts[i]).find("#timespan_link_time").text(),text: $(mass_posts[i]).find("#timespan_link_text").text()}
            }
        $("#add_text_timestamp").click(function(){
            var time = myPlayer.currentTime();
            var timsp_text = $("#timespan_text").val();
            var view_name = $("#p_v_name").text();
            if(time != 0 && timsp_text != "")
                {
                    $.post("add_timespan_logic.php",{time:time,text:timsp_text,view_name:view_name},function(data){
                    });
                }
            $(".info").css('height','36px');
            $(".add_timespan").css('display','none');
            myPlayer.play();
            $(".t_spans_block").load("ajax_refresh_timestamps.php",function(){

            });
        });

        $("#show_block_add").mouseenter(function(){
            $(this).text("Add timespan");
            $(this).css('white-space','nowrap');
            $(this).css('overflow','hidden');
        }).mouseleave(function(){
            $(this).text("+");
        }).click(function(){
            $(".info").css('height','126px');
            $(".add_timespan").css('display','block');
            myPlayer.pause();
            $("#timespan_text").val(" ");
        });

        $(".timespan_link_div").click(function(){
            //alert($(this).find("#timespan_link_time").text());
            var t = $(this).find("#timespan_link_time").text();
            myPlayer.currentTime(t);
        });
        
        myPlayer.markers({markerTip:{
         display: true,
         text: function(marker){
            return marker.text;
         }
        },
        markerStyle:{'width':'3px','background-color':'white','border-radius':'50%'},
        markers: mas});
    </script>
</body>
</html>
