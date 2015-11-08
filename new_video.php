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
            });
        });
</script>
   <?php
        include("header.php");
        include("sidebar.php");
    ?>
    <div class="cont" id="mainContent">
          <p>ADD NEW VIDEO</p>
        <form action="add_video_logic.php" method="post" name="add_video_form" id="add_video_form_id">
            <p>Enter video name</p>
            <input type="text" name="name_video" placeholder="Video Name" id="video_name_input">
            <p>Create video description</p>
            <textarea name="desciption_video" placeholder="Description" id="video_desc_input"></textarea>
            <div class="upload"></div>
            <!--<input type="submit" value="Add video" name="add_video_button" class="apply">-->
            <input type="button" value="Add video" name="add_video_button" class="apply" id="add_v_b">
        </form>
    </div>
    <script>
        $(document).ready(function(){
            $('#add_v_b').click(function(){
                $.post('add_video_logic.php',function(data){
                   alert(data); 
                });
            });
        });
    </script>
</body>
</html>