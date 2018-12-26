<?php
    require "../functions/connect.php";
    connectDB();
    require "../functions/chat.php";

    $dialog = getDialog("`send` = ".$_SESSION['logged_user']['u_id']." OR `recive` = ".$_SESSION['logged_user']['u_id']."");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        $title = "Сообщения";
        require_once "../blocks/head.php";
    ?>
</head>
<body>
    <?php
        require_once "../blocks/header.php";
        
    ?>

    <div>
        <div class = "dialog-list">
            <ul>
                <?php
                    for($i = 0; $i < count($dialog); $i++){
                        $user = findUser("`u_id` <> ".$_SESSION['logged_user']['u_id']." AND `u_id` = ".$dialog[$i]['recive']." OR `u_id` = ".$dialog[$i]['send']."");
                        $message = getMessages("`d_id` = ".$dialog[$i]['id']." ORDER BY `id` DESC LIMIT 1;"); // Нахождение последнего сообщения данного диалога для отображения его данных
                        echo'
                        <a href = "chat.php?dialogId='.$dialog[$i]['id'].'">
                        <li class = "dialog">
                            <span class = "dialog-user ">'.$user['u_fio'].'</span>
                            <span class = "dialog-message">message: '.$message[0]['text'].'</span>
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