<?php
    $data = $_POST;
    if(isset($data['do_edit'])){
            editAd($data);
            if(!empty($_FILES['fileMulti']['name']))
                addPhoto($data);
        }
    function editAd($data){
        global $mysqli;
        $result = update("`ad`", "`a_title` = '".$data['title']."', `a_tag` = '".$data['tag']."', `a_subtag` = '".$data['subtag']."', `a_descr` = '".$data['descr']."', `a_price` = '".$data['price']."', `a_condition` = '".$data['condition']."', `a_city` = '".$data['city']."'", "`a_id` = '".$data['id']."'");

        if($result){
            echo '<script type="text/javascript">window.location.href = "../pages/My_page.php"</script>';
            showMessage("INFO", "Обьявление отредактировано успешно");
        }else{
            showMessage("ERROR", "Обьявление не было отредактировано");
        }
    }
    function addPhoto($data){
        
        if (is_dir("../Images/".$data['id']."")){
            rmdir("../Images/".$data['id']."");
        }


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
        update("`ad`", "`photo_num` = ".$count."", "`a_id` = ".$data['id']."");
    }
?>