<?php
    if(isset($_POST['leave_favorite'])){
        require "connect.php";
        connectDB();

        delete("`favorite_ad`", "`a_id` = ".$_POST['leave_favorite']." AND `u_id` = ".$_SESSION['logged_user']['u_id']."");
        
        closeDB();
    }
?>