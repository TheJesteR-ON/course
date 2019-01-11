<?php
    $data = $_POST;
    if(isset($data['do_edit'])){
            editAd($data);
            addPhoto($data);
        }
    function editAd($data){
        update("`ad`", "`a_title` = '".$data['title']."', `a_tag` = '".$data['tag']."', `a_descr` = '".$data['descr']."', `a_price` = '".$data['price']."', `a_condition` = '".$data['condition']."', `a_city` = '".$data['city']."'", "`a_id` = '".$data['id']."'");
    }
    function addPhoto($data){

        mkdir("../Images/".$data['id']."");
        $count = 0;
        foreach ($_FILES['fileMulti']['name'] as $filename) 
            {
                $tmp = $_FILES['fileMulti']['tmp_name'][$count];
                $count = $count + 1;
                $temp = "../Images/".$data['id']."/".$count.".jpg";
                move_uploaded_file($tmp, $temp);
                $temp = '';
                $tmp = '';
            }
    }
?>