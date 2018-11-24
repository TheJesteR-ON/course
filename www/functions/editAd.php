<?php
    $data = $_POST;
    if(isset($data['do_edit'])){
            editAd($data);
        }
    function editAd($data){
        global $mysqli;
        $result_set = $mysqli->query("UPDATE `ad` SET `a_title` = '".$data['title']."', `a_descr` = '".$data['descr']."', `a_price` = '".$data['price']."'  WHERE `a_id` = '".$data['id']."'");
    }
?>