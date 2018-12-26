<?php
    require "../functions/connect.php";
    connectDB();
    require "../functions/chat.php";
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
    <script src="../js/chat.js"></script>

    <style>
        #msg-box{overflow:auto; width:750px; height:300px; border:1px solid black; padding:5px; margin:0px; display:inline-block; background:#FFF; margin:32px 0 0 32px;}
        #msg-box ul{list-style:none; padding:0px; margin:0px;}
        #t-box{margin-left:32px;}
    </style>
</head>
<body>
    <?php
        require_once "../blocks/header.php";
        
        
        $message = getMessages("`d_id` = ".$_GET['dialogId']."");
    ?>
<br><br><br><br><br><br>
    <div>
        <div class = "main-chat">
            <div id="msg-box">
                <ul>
                    <?php
                        for($i=0; $i < count($message); $i++){
                            $user = findUser("`u_id` = ".$message[$i]['user']."");
                            echo'<li>'.$user['u_fio'].' '.$message[$i]['text'].'</li>';
                        }
                    ?>
                </ul>
            </div>
            <form action="chat.php?<?php echo'dialogId='.$_GET['dialogId'].''?>" method="post">
                <input type="text" name="message" id="">
                <input type="submit" name = "do_send" value="Отправить">
            </form>
            
        </div>
    </div>
    
    <br>
    <?php require_once "../blocks/footer.php";?>

</body>
</html>