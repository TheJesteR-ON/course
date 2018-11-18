<?php
    if(isset($_POST['do_delete'])){
            $id = $_POST['deleteId'];
            global $mysqli;
            $result_set = $mysqli->query("UPDATE `ad` SET `a_delete` = '1' WHERE `a_id` = '$id'");
        }

?>