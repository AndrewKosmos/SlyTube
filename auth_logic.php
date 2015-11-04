<?php
    include("site_logic.php");
    $login = $_POST['log_name'];
    $password = $_POST['log_pass'];
    $checkbox_result = verify_one_checkbox('remember');

    $newuser = new user($login,$password);
    if($newuser->Authorization($login,$password,$checkbox_result))
    {
        $newuser->Authorization($login,$password,$checkbox_result);
    }
    else
    {
        ?>
            <script>
                alert("Incorrect Login or Password!!!");
            </script>
        <?php
        header("Location: index.php");
    }
?>
