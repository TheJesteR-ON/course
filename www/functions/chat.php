<?php

    if(isset($_POST['do_send'])){
        $dialog = getDialog("`id` = ".$_GET['dialogId']."");
        $user = findUser("(`u_id` = ".$dialog[0]['recive']." OR `u_id` = ".$dialog[0]['send'].") AND `u_id` <> ".$_SESSION['logged_user']['u_id']."");
        sendMessage($user['u_id'], $_POST['message']);
    }
    if(isset($_GET['dialog'])){
        require "connect.php";
        connectDB();

        $message = getMessages("`d_id` = ".$_GET['dialog']." ORDER BY `id` ASC");
        echo'<ul>';
            for($i=0; $i < count($message); $i++){
                $user = findUser("`u_id` = ".$message[$i]['user']."");
                echo'<li>'.$user['u_fio'].' '.$message[$i]['text'].'</li>';
            }
        echo'</ul>';
    }
     if(isset($_GET['dialog-list'])){
        require "connect.php";
        connectDB();
        
        $dialog = getDialog("`send` = ".$_SESSION['logged_user']['u_id']." OR `recive` = ".$_SESSION['logged_user']['u_id']."  ORDER BY `id` DESC");
        echo'<ul>';
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
        echo'</ul>';
    } 
?>