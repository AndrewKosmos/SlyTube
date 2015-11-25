<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Video</title>
    <link rel="stylesheet" href="stylesheets/style.css">
    <link rel="stylesheet" href="stylesheets/upload.css">
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/core.js"></script>
    <script src="js/upload.js"></script>
</head>
<body>
<script>
        jQuery('document').ready(function($){
            $('.upload').upload({
            	action:'add_video_worker.php',
                postKey:'newvideo',
                maxQueue:1,
                maxSize:524288000
            }).on("start.upload",Start);
        });
    
    function Start(e,files)
    {
        console.log("Start");
        var html = '';
        for(var i = 0 ; i < files.length; i++)
            {
                html += '<span class="file">' + files[i].name + '</span><progress value="0" max = "100"></progress>';
            }
    }
</script>
   <?php
        include("header.php");
        include("sidebar.php");
    ?>
    <div class="cont" id="mainContent">
          <p>ADD NEW VIDEO</p>
        <form action="" method="post" name="add_video_form" id="add_video_form_id" enctype="multipart/form-data">
            <p>Enter video name</p>
            <div id="error_block">Fill Name field please!</div>
            <input type="text" name="name_video" placeholder="Video Name" id="video_name_input">
            <p>Create video description</p>
            <textarea name="desciption_video" placeholder="Description" id="video_desc_input"></textarea>
            <input type="button" value="Remember video Settings" name="add_video_button" class="apply" id="add_v_b">
            <div class="upload" id="upload_video"></div>
            <!--<input type="button" value="Remember video Settings" name="add_video_button" class="apply" id="add_v_b">-->
            <!--<input type="submit" value="Add video" name="add_video_button" class="apply">-->
            <div id="result_upload"></div>
        </form>
    </div>
    <script>
        $(document).ready(function(){
            $('#add_v_b').click(function(){
                var name = $("#video_name_input").val();
                var desc = $("#video_desc_input").val();
                if(name != "")
                    {
                        $.post("add_video_logic.php",{name:name,desc:desc},function(data){
                            $('#upload_video').css('display','block');
                            $('#error_block').css('display','none');
                        });
                    }
                    else
                    {
                        $('#error_block').css('display','inline-block');
                        $('#upload_video').css('display','none');
                    }
            });
        });
    </script>
</body>
</html>