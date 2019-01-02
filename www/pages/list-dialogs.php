<?php
    require "../functions/connect.php";
    connectDB();
    require "../functions/chat.php";

    $dialog = getDialog("`send` = ".$_SESSION['logged_user']['u_id']." OR `recive` = ".$_SESSION['logged_user']['u_id']."  ORDER BY `id` DESC");

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
    <script src="../js/dialogs.js"></script>
</head>
<body>
    <?php
        require_once "../blocks/header.php";
        
    ?>
<br><br><br>

    <div style ="margin: auto; width: 90%; height: 700px; vertical-align: top;">
        <div class = "dialog-list" style = "display: inline-block; height: 700px; float: left; width: 40%;">
            <ul>
                <?php
                    for($i = 0; $i < count($dialog); $i++){
                        $user_with = findUser("(`u_id` = ".$dialog[$i]['recive']." OR `u_id` = ".$dialog[$i]['send'].") AND `u_id` <> ".$_SESSION['logged_user']['u_id']."");
                        $message = getMessages("`d_id` = ".$dialog[$i]['id']." ORDER BY `id` DESC LIMIT 1;"); // Нахождение последнего сообщения данного диалога для отображения его данных
                        $user_from = findUser("`u_id` = ".$message[0]['user']."");

                        if(($dialog[$i]['status'] == 0) && ($dialog[$i]['recive'] == $_SESSION['logged_user']['u_id'])){
                            $not_read = 'style = "background-color: grey;"';
                        }else{
                            $not_read = '';
                        }

                        $date = getThisDate($message[0]['date']);
                        $time = getThisTime($message[0]['date']);
                        
                        echo'
                        <a id = "dialog-src" onclick = \'changeDialog('.$dialog[$i]['id'].')\'>
                        <li '.$not_read.' class = "dialog" onclick = \'changeDialog('.$dialog[$i]['id'].')\'>
                            <span class = "dialog-user ">'.$user_with['u_fio'].'</span>
                            <span class = "dialog-message">'.$user_from['u_fio'].' : '.$message[0]['text'].'</span>
                            <span class = "dialog-time">'.$time.' '.$date.'</span>
                        </li>
                        </a>
                        ';
                    }
                ?>
            </ul>
        </div>
        <div style = "display: inline-block; width: 55%">
            <iframe id = "dialog-iframe" src="chat.php?dialogId=<?php echo $dialog[0]['id']?>" style = "width: 100%; height: 700px; border: 1px solid lightgrey; border-radious: 5px;"></iframe>
        </div>

    </div>
    
    <br>
    <?php require_once "../blocks/footer.php";?>

</body>
<script>
    function changeDialog(id){
        document.getElementById('dialog-iframe').src = "chat.php?dialogId="+id;
    }
</script>
</html>