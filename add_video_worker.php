<?php
    print_r($_FILES);
    include("site_logic.php");
    $_SESSION["newvideo"] = $_FILES['newvideo'];
    $check = video_worker::checkFile($_SESSION["newvideo"]);
    if($check && !empty($_SESSION["video_name"]))
    {
        $DB = connectDB();
        move_uploaded_file($_SESSION["newvideo"]["tmp_name"],"videos/" .$_SESSION["video_name"] . ".mp4");
        $query = "insert into videos(Name,Description,Path,userID) values (:name, :desc, :path, :userid)";
        $q = $DB->prepare($query);
        try{
                $DB->beginTransaction();
                $result = $q->execute(array(
                ':name' => $_SESSION["video_name"],
                ':desc' => $_SESSION["video_desc"],
                ':path' => "videos/" .$_SESSION["video_name"] . ".mp4",
                ':userid' => $_SESSION['user_id']
                ));
                $DB->commit();
                echo "Uploaded";
            }
            catch(\PDOException $e)
            {
                $DB->rollBack();
                echo "Database error:" . $e->getMessage();
                die();
            }
    }
    else
    {
        echo "Fill Name pls";
    }
?>