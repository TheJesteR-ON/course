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
                
                if($user['u_id'] == $_SESSION['logged_user']['u_id'])
                    $message_class = "message_mine";
                else
                    $message_class = "message_yours";

                $date = new DateTime(''.$message[$i]['date'].'');
                if($i == 0){
                    echo'<li style = "text-align: center;">'.$date->format("d.m.Y").'</li>';
                }
                echo'<li class = "'.$message_class.' message"><span class = "message-text">'.$message[$i]['text'].' <span class = "message-time">'.$date->format("H:i").'</span></span></li>';

                if($i < count($message) - 1){
                    $date_next = new DateTime(''.$message[$i+1]['date'].'');
                    if($date->format("d.m.Y") != $date_next->format("d.m.Y")){
                        echo'<li class ="message" style = "text-align: center;">'.$date_next->format("d.m.Y").'</li>';
                    }
                }
            }
        echo'</ul>';
    }
     if(isset($_GET['dialog-list'])){
        require "connect.php";
        connectDB();
        
        $dialog = getDialog("`send` = ".$_SESSION['logged_user']['u_id']." OR `recive` = ".$_SESSION['logged_user']['u_id']."  ORDER BY `id` DESC");
        if($dialog){
            echo'<table class = "dialog-table">';
                for($i = 0; $i < count($dialog); $i++){
                    $user_with = findUser("(`u_id` = ".$dialog[$i]['recive']." OR `u_id` = ".$dialog[$i]['send'].") AND `u_id` <> ".$_SESSION['logged_user']['u_id']."");
                    $message = getMessages("`d_id` = ".$dialog[$i]['id']." ORDER BY `id` DESC LIMIT 1;"); // Нахождение последнего сообщения данного диалога для отображения его данных
                    $user_from = findUser("`u_id` = ".$message[0]['user']."");

                    if(($dialog[$i]['status'] == 0) && ($dialog[$i]['recive'] == $_SESSION['logged_user']['u_id'])){
                        $not_read = 'style = "background: #2fbdb4 ;color: white;"';
                    }else{
                        $not_read = '';
                    }

                    /* $date = new DateTime(''.$message[0]['date'].''); */
                    $date = getThisDate($message[0]['date']);
                    $time = getThisTime($message[0]['date']);
                    
                    echo'
                    <tr '.$not_read.' class = "dialog" onclick = \'changeDialog('.$dialog[$i]['id'].')\'>
                        <td class = "dialog-user ">'.$user_with['u_fio'].'</td>
                        <td  class = "dialog-message">'.$user_from['u_fio'].': '.$message[0]['text'].'</td>
                        <td class = "dialog-time">'.$time.' '.$date.'</td>
                    </tr>
                    ';
                }
            echo'</table>';
        }else{
            require_once "../blocks/no_ad.php";
        }
    } 
?>