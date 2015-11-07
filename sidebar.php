<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <div class="side">
            <ul>
                <li><a href="index.php" class="menu-ref home">Home</a></li>
                <li><a class="menu-ref categ" onclick="">Categories</a></li>
                
                <?php
                if($sost)
                {
                    ?>
                <li><a class="menu-ref latest-vid">New video</a></li>
                <li><a class="menu-ref account">My Account</a></li>
                <li><a class="menu-ref my-vid">My videos</a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
</body>
</html>