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
<br><br><br><br><br><br><br><br><br><br>

    <div>
        <div class = "dialog-list">
            <ul>
                <?php
                    for($i = 0; $i < count($dialog); $i++){
                        $user_with = findUser("(`u_id` = ".$dialog[$i]['recive']." OR `u_id` = ".$dialog[$i]['send'].") AND `u_id` <> ".$_SESSION['logged_user']['u_id']."");
                        $message = getMessages("`d_id` = ".$dialog[$i]['id']." ORDER BY `id` DESC LIMIT 1;"); // Нахождение последнего сообщения данного диалога для отображения его данных
                        $user_from = findUser("`u_id` = ".$message[0]['user']."");
                        echo'
                        <a href = "chat.php?dialogId='.$dialog[$i]['id'].'">
                        <li class = "dialog">
                            <span class = "dialog-user ">'.$user_with['u_fio'].'</span>
                            <span class = "dialog-message">'.$user_from['u_fio'].' : '.$message[0]['text'].'</span>
                            <span class = "dialog-time">date: '.$message[0]['date'].'</span>
                        </li>
                        </a>
                        ';
                    }
                ?>
            </ul>
        </div>

    </div>
    
    <br>
    <?php require_once "../blocks/footer.php";?>

</body>
</html>