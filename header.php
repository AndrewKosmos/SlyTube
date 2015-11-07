<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
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
                    ?>
                        <div class="defined-user">
                           <div id="small_avatar"></div>
                            <a href="#"><?php echo $ActiveUser; ?></a>
                            <form id="logout_form" action="logout_logic.php" name="logout" method="post">
                                <input type="submit" value="Exit" id="l_out" name="lout_but">
                            </form>
                        </div>
                    <?php
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
                
                <p id="or">...or</p>
                <a href="registration.php" class="ssilk reg">Register</a>
            </div>
        </div>
        
        <div id="shirm"></div>
</body>
</html>