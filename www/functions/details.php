<?php
    if(isset($_GET['do_send'])){
        $dialog_already = getDialog(" 
        `recive` = ".$_GET['user_id']." AND 
        `send` = ".$_SESSION['logged_user']['u_id']." 
        OR `recive` = ".$_SESSION['logged_user']['u_id']." 
        AND `send` = ".$_GET['user_id']."");

        if(!$dialog_already){
            sendMessage($_GET['user_id'], "Чат личных сообщений начат");
            $created_dialog = getDialog("`id` = (SELECT MAX(id) FROM `dialog`)");
            
            $dialog_id = $created_dialog[0]['id'];
        }else{
            $dialog_id = $dialog_already[0]['id'];
        }
        echo '<script type="text/javascript">window.location.href = "../pages/list-dialogs.php"</script>';
    }

    function addView(){
        global $mysqli;
        mysqli_query($mysqli,"UPDATE `ad` SET `a_views` = `a_views` + 1 WHERE `a_id` = '".$_GET['id']."'");
    }
?>