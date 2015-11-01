<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" href="stylesheets/style.css">
</head>
<body>
   <style>
       body{
           background-color: #f1f1f1;
       }
    </style>
    <p id="reg_label">Registration</p>
    <form action="registration_logic.php" name="regform" method="post" id="reg_form">
        <input type="text" class="in_pole" placeholder="Login" name="input_login">
        <input type="password" class="in_pole" placeholder="Password" name="input_pass">
        <input type="text" class="in_pole" placeholder="email" name="input_mail">
        
        <input type="submit" class="apply" value="Sign Up!">
    </form>
</body>
</html>