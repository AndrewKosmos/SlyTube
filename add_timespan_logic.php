<?php
    include("site_logic.php");
    $name = trim($_POST['view_name']);
    $DB = connectDB();
    $query = "select ID from videos where Name='".$name."'";
    $q = $DB->prepare($query);
    $q->execute();
    $row = $q->fetch();
    $id = $row["ID"];
    /*echo $_POST['time'] . "/" . $_POST['text'] . "/" . $_SESSION['user_id'] . "///" . trim($_POST['view_name']) . "==>" . $id;*/
    $insert_sql = "insert into timespans(IDVideo,IDUser,text,time) values (:idvideo,:iduser,:text,:time)";
    $q = $DB->prepare($insert_sql);
    try{
        $DB->beginTransaction();
        $result = $q->execute(array(
            ':idvideo' => $id,
            ':iduser' => $_SESSION['user_id'],
            ':text' => $_POST['text'],
            ':time' => $_POST['time']
        ));
        $DB->commit();
    }
    catch(\PDOException $e)
    {
        $DB->rollBack();
        echo "Database error:" . $e->getMessage();
        die();
    }
?>