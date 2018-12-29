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
?>