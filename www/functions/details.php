<?php
    if(isset($_GET['sendToUser'])){
        sendMessage($_GET['sendToUser'], "Чат личных сообщений начат");
        $created_dialog = getDialog("`id` = (SELECT MAX(id) FROM `dialog`)");
        echo '<script type="text/javascript">window.location.href = "../pages/chat.php?dialogId='.$created_dialog[0]['id'].'"</script>';
    }
?>