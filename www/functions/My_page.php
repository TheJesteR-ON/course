<?php
    if(isset($_POST['do_delete'])){
        $id = $_POST['deleteId'];
        global $mysqli;

        update("`ad`", "`a_delete` = '1'", "`a_id` = '".$id."'");
        showMessage("INFO", "Запись была деактивирована");
    }
    if(isset($_POST['do_active'])){
        $id = $_POST['deleteId'];
        global $mysqli;

        update("`ad`", "`a_delete` = '0'", "`a_id` = '".$id."'");
        showMessage("INFO", "Запись была активирована");
    }
    if(isset($_POST['do_really_delete'])){
        $id = $_POST['deleteId'];
        global $mysqli;

        delete("`ad`", " `a_id` = '$id'");
        showMessage("INFO", "Запись была полностью удалена");
    }
    if(isset($_POST['do_edit'])){
        $id = $_POST['deleteId'];
        echo '<script type="text/javascript">window.location.href = "../pages/editAd.php?updateId='.$id.'"</script>';
    }

?>