<?php
    require "../functions/connect.php";
    connectDB();
    require "../functions/chat.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        $title = "Сообщения";
        require_once "../blocks/head.php";
    ?>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script type="text/javascript" src="../js/jquery.timers/jquery.timers.js"></script>
    <script type="text/javascript" scr = "../js/jquery-cookie/src/jquery.cookie.js"></script>
    <script src="../js/chat.js"></script>
</head>
<body style = "background: white;">
    <?php
        /* require_once "../blocks/header.php"; */
    
        $message = getMessages("`d_id` = ".$_GET['dialogId']." ORDER BY `id` ASC");

        $this_dialog = getDialog("`id` = ".$_GET['dialogId']."");

        if(($this_dialog[0]['status'] == 0) && ($this_dialog[0]['recive'] == $_SESSION['logged_user']['u_id'])){
            mysqli_query($mysqli,"UPDATE `dialog` SET `status` = 1 WHERE `id` = ".$this_dialog[0]['id']."");
        }
    ?>
<input style = "display: none" type="text" id="n_dialog" value = "<?php echo $_GET['dialogId'] /* Для взятия номера диалога при ajax */?>">

    <div>
        <div class = "main-chat">
            <div id="msg-box">
                <ul>
                    <?php
                        for($i=0; $i < count($message); $i++){
                            $user = findUser("`u_id` = ".$message[$i]['user']."");
                            
                            if($user['u_id'] == $_SESSION['logged_user']['u_id'])
                                $message_class = "message_mine";
                            else
                                $message_class = "message_yours";

                            $date = new DateTime(''.$message[$i]['date'].'');
                            if($i == 0){
                                echo'<li style = "text-align: center;">'.$date->format("d.m.Y").'</li>';
                            }
                            echo'<li class = "'.$message_class.' message"><span class = "message-text">'.$message[$i]['text'].'  <span class = "message-time">'.$date->format("H:i").'</span></span></li>';

                            if($i < count($message) - 1){
                                $date_next = new DateTime(''.$message[$i+1]['date'].'');
                                if($date->format("d.m.Y") != $date_next->format("d.m.Y")){
                                    echo'<li class ="message" style = "text-align: center;">'.$date_next->format("d.m.Y").'</li>';
                                }
                            }
                        }
                    ?>
                </ul>
            </div>

            <form style = "position: fixed; bottom: 0px;" id="t-box" action="chat.php?<?php echo'dialogId='.$_GET['dialogId'].''?>" method="post">
                <input class = "input-text" type="text" name="message" id="">
                <input class = "input-submit" type="submit" name = "do_send" value="Отправить">
            </form>
            
        </div>
    </div>
    
    <br>
    <!-- <?php require_once "../blocks/footer.php";?> -->

</body>
</html>