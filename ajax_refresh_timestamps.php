<?php
    include("site_logic.php");
    $DB = connectDB();
                $query = "select ID from videos where Name='".$_SESSION['curr_video']."'";
                $q = $DB->prepare($query);
                $q->execute();
                $row = $q->fetch();
                $id = $row["ID"];
                $qq = "select Login,text,time from timespans join users on timespans.IDUser = users.ID where IDVideo = :id";
                $q = $DB->prepare($qq);
                $q->execute(array(':id' => $id));
                while($row = $q->fetch(PDO::FETCH_ASSOC))
                {
                    ?>
                        <div class="timespan_link_div">
                            <p id="timespan_user"><?php echo $row['Login'] ?></p>
                            <p id="timespan_link_time"><?php echo $row['time'] ?></p>
                            <p id="timespan_link_text"><?php echo $row['text'] ?></p>
                        </div>
                    <?php
                }
?>