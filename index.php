<?php
    //include("site_logic.php");
    //session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SlyTube</title>
    <link rel="icon" href="favicon2.png" type="image/png">
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
            <?php   
                $dbh = connectDB();
                $query = "select Name,Login from videos join users on videos.userID = users.ID order by videos.ID DESC limit 10";
                $q = $dbh->prepare($query);
                $q->execute();
                while($row = $q->fetch(PDO::FETCH_ASSOC))
                {
                    ?>
                        
                        <div class="vid_prev">
                            <div class="pic"></div>
                            <a class="v_name"><?php echo $row['Name'];  ?></a>
                            <p id="v_user"><?php echo $row['Login'] ?></p>
                        </div>
                        
                    <?php 
                    
                }
            ?>
        </div>
        <!--   FOOTER     -->
        <?php include("footer.php"); ?>
    </div>
    <script src="js/modal-userlogin.js"></script>
    <script>
        $(document).ready(function(){
            $('.v_name').click(function(){
                var v_name = $(this).text();
                $.post("view_video_bgworker.php",{v_name:v_name},function(data){
                            location.href='view_video.php';
                        });
            });
        });
    </script>
</body>
</html>
