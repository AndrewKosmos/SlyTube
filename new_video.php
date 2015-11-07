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
            	
            });
        });
</script>
   <?php
        include("header.php");
        include("sidebar.php");
    ?>
    <p>ADD NEW VIDEO</p>
    <form action="" method="post" name="add_video_form" id="add_video_form_id">
        <input type="text" name="name_video" placeholder="Video Name">
        <textarea name="desciption_video" placeholder="Description"></textarea>
        <div class="upload"></div>
    </form>
</body>
</html>