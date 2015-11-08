<?php
    //include("site_logic.php");
    //session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TEST</title>
    <link rel="stylesheet" href="stylesheets/style.css">
    <link rel="stylesheet" href="stylesheets/video-js.css">
    <link rel="stylesheet" href="stylesheets/upload.css">
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/video.js"></script>
    <script src="js/core.js"></script>
    <script src="js/upload.js"></script>
</head>
<body>
    <div class="wrap">
      <!--  HEADER -->
       <?php include("header.php"); ?>
        
        <!-- SIDEBAR -->
        <?php include("sidebar.php"); ?>
        
        <!-- CONTENT  -->
        <div class="cont" id="mainContent">
            <p>Last videos</p>
        </div>
        <div class="footer"></div>
    </div>
    <script src="js/modal-userlogin.js"></script>
    <script src="js/ajax-changepage.js"></script>
</body>
</html>
