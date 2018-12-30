<?php
    if(isset($_GET['sendToUser'])){
        $dialog_already = getDialog(" 
        `recive` = ".$_GET['sendToUser']." AND 
        `send` = ".$_SESSION['logged_user']['u_id']." 
        OR `recive` = ".$_SESSION['logged_user']['u_id']." 
        AND `send` = ".$_GET['sendToUser']."");

        if(!$dialog_already){
            sendMessage($_GET['sendToUser'], "Чат личных сообщений начат");
            $created_dialog = getDialog("`id` = (SELECT MAX(id) FROM `dialog`)");
            
            $dialog_id = $created_dialog[0]['id'];
        }else{
            $dialog_id = $dialog_already[0]['id'];
        }
        echo '<script type="text/javascript">window.location.href = "../pages/chat.php?dialogId='.$dialog_id.'"</script>';
    }
?>