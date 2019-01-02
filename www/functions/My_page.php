<?php
    if(isset($_POST['do_delete'])){
        $id = $_POST['deleteId'];
        global $mysqli;
        $result_set = $mysqli->query("UPDATE `ad` SET `a_delete` = '1' WHERE `a_id` = '$id'");
    }
    if(isset($_POST['do_really_delete'])){
        $id = $_POST['deleteId'];
        global $mysqli;
        $result_set = $mysqli->query("UPDATE `ad` SET `a_delete` = '1' WHERE `a_id` = '$id'");
    }
    if(isset($_POST['do_edit'])){
        $id = $_POST['deleteId'];
        echo '<script type="text/javascript">window.location.href = "../pages/editAd.php?updateId='.$id.'"</script>';
    }

?>