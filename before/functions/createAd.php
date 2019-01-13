<?php
    $data = $_POST;
    if(isset($data['do_publish'])){
        
        //echo"".$_SESSION['logged_user']['u_id'].", '".$data['title']."', '".$data['tag']."', '".$data['condition']."', '".$data['city']."', '".$data['descr']."', 0, ".$data['price']."";

        if(insertInto("`ad`", "`u_id`, `a_title`, `a_tag`, `a_subtag`,`a_condition`, `a_city`, `a_descr`, `a_views`, `a_price`",
        "'".$_SESSION['logged_user']['u_id']."', '".$data['title']."', '".$data['tag']."', '".$data['subtag']."' , '".$data['condition']."', '".$data['city']."', '".$data['descr']."',0 ,'".$data['price']."'")){
             showMessage("INFO", "Успешно");
         }else{
            showMessage("ERROR", "Неуспешно");
         }
        
         //saveAd($_SESSION['logged_user']['u_id'], $data['title'], $data['tag'], $data['condition'], $data['city'], $data['descr'], $data['price']);
        makeDir($data);

    }

    if(isset($_GET['type_id'])){
        require "connect.php";
        connectDB();
        $subtypes = selectFrom("*", "`subtypes`", "`t_id` = ".$_GET['type_id']."");
        echo'<option value="">Всё</option>';
        for($i = 0; $i < count($subtypes); $i++){
            echo '
                <option value="'.$subtypes[$i]['st_name'].'">'.$subtypes[$i]['st_name'].'</option>
            ';
        }
    }

    function makeDir($data){
        $ad = findAd("a_id = (Select MAX(a_id) from ad)"); //Нахождение максимального индекса для создания папки в дальнейшем

        mkdir("../Images/".$ad['a_id']."");
        $count = 0;
        foreach ($_FILES['fileMulti']['name'] as $filename) 
            {
                $tmp = $_FILES['fileMulti']['tmp_name'][$count];
                $count = $count + 1;
                $temp = "../Images/".$ad['a_id']."/".$count.".jpg";
                move_uploaded_file($tmp, $temp);
                $temp = '';
                $tmp = '';
            }
        update("`ad`", "`photo_num` = ".$count."", "`a_id` = ".$ad['a_id']."");
    }
    /* function saveAd($in_user, $in_title, $in_tag, $in_cond, $in_city, $in_descr, $in_price){
        global $mysqli;

        $sql = "INSERT INTO `ad` (`a_id`, `u_id`, `a_title`, `a_tag`,`a_condition`, `a_city`, `a_descr`, `a_views`, `a_price`) 
        VALUES (NULL, '$in_user', '$in_title', '$in_tag','$in_cond', '$in_city', '$in_descr', '0', '$in_price');";

        if ($mysqli->query($sql) === TRUE) {
            $er = 0;
        } else {
            showMessage("ERROR",$sql."<br>".$mysqli->error);
        }
    } */

    
?>