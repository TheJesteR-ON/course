<?php

    if(isset($_POST['do_send'])){
        $dialog = getDialog("`id` = ".$_GET['dialogId']."");
        $user = findUser("`u_id` <> ".$_SESSION['logged_user']['u_id']." AND `u_id` = ".$dialog[0]['recive']." OR `u_id` = ".$dialog[0]['send']."");
        sendMessage($user['u_id'], $_POST['message']);
    }

    function sendMessage($userId, $message){
        global $mysqli;

         if($userId == $_SESSION['logged_user']['u_id']){
            $errors[] = "Отправка сообщение самому себе невозможна!";
        }else{

            /* $touser = findUser("`u_fio` = '$login'");
            if(!$touser){
                $errors[] = "Не найдено пользователя с таким логином!";
            } */

            $dialog = mysqli_query($mysqli,"SELECT * FROM `dialog` WHERE `recive` = ".$userId." AND `send` = ".$_SESSION['logged_user']['u_id']." OR `recive` = ".$_SESSION['logged_user']['u_id']." AND `send` = ".$userId."");
            $dialog = $dialog->fetch_assoc();
            if($dialog){
                $dialog_id = $dialog['id'];
                mysqli_query($mysqli,"UPDATE `dialog` SET `status` = 0, `send` = ".$_SESSION['logged_user']['u_id'].", `recive` = ".$userId." WHERE `id` = $dialog_id");
            }else{
                mysqli_query($mysqli,"INSERT INTO `dialog` VALUES ('', 0, ".$_SESSION['logged_user']['u_id'].", ".$userId.")");
                $dialog_id = mysqli_insert_id($mysqli);
            }
            
            if(empty($errors)){
                //Если нет ошибок
                $mysqli->query("INSERT INTO `message` VALUES ('', ".$dialog_id.", ".$_SESSION['logged_user']['u_id'].", '$message', NOW())");
            }
            else{
                //Вывод ошибки
                echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
                
            } 
        }
    }
?>