<?php
    include("site_logic.php");
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TEST</title>
    <link rel="stylesheet" href="stylesheets/style.css">
    <link rel="stylesheet" href="stylesheets/video-js.css">
    <script src="js/video.js"></script>
</head>
<body>
    <div class="wrap">
        <div class="header">
           <div class="logo"></div>
            <div class="phone_menu">
                <div id="phone_menu_icon"></div>
            </div>
            <div class="searching">
                <input class="search_input" type="text" placeholder="Search...">
            </div>
            <?php
                $sost = user::isAuthorized();

                if(!$sost)
                {
                    ?>
                    <div class="nondefined-user" onclick="showWin();">
                        <div id="nondef-user-icon" onclick="showWin();"></div>
                    </div>
                <?php
                }
                else{
                    $ActiveUser = getActiveUser($_SESSION['user_id']);
                    echo $ActiveUser;
                }
            ?>
            
        </div>
        
        <div id="win">
            <div id="loginform">
                <div class="close" onclick="hideAll();">
                    <svg width="16px" height="16px">
                            <line x1="0" y1="0" x2="16" y2="16" stroke-width="1" stroke="white"/>
                            <line x1="0" y1="16" x2="16" y2="0" stroke-width="1" stroke="white"/>
                        </svg>
                </div>
                <p>Login</p>
                <form action="auth_logic.php" name="signup_form" method="post">
                    <input type="text" id="login" placeholder="Username" name="log_name">
                    <input type="password" id="pass" placeholder="Password" name="log_pass">
                    <label><input type="checkbox" id="remember" name="remember">Remember me</label>
                    <input type="submit" id="login-button" value="Sign up!">
                </form>
                <a href="registration.php" class="ssilk reg">Register</a>
                <a href="#" class="remind ssilk">Forgot password?</a>
            </div>
        </div>
        
        <div id="shirm"></div>
        
        <!-- SIDEBAR -->
        <div class="side">
            <ul>
                <li><a href="" class="menu-ref home">Home</a></li>
                <li><a href="" class="menu-ref categ" onclick="">Categories</a></li>
                <li><a href="" class="menu-ref latest-vid">New videos</a></li>
                <li><a href="" class="menu-ref account">My Account</a></li>
                <li><a href="" class="menu-ref my-vid">My videos</a></li>
            </ul>
        </div>
        <div class="cont" id="mainContent">
            
        </div>
        <div class="footer"></div>
        <div id="preloader">LOADING</div>
    </div>
    <script src="js/modal-userlogin.js"></script>
</body>
</html>