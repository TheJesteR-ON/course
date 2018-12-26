<?php
    $data = $_POST;
    if(isset($data['do_publish'])){

        saveAd($_SESSION['logged_user']['u_id'], $data['title'], $data['tag'], $data['condition'], $data['city'], $data['descr'], $data['price']);
        makeDir($data);
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
    }
    function saveAd($in_user, $in_title, $in_tag, $in_cond, $in_city, $in_descr, $in_price){
        global $mysqli;

        $sql = "INSERT INTO `ad` (`a_id`, `u_id`, `a_title`, `a_tag`,`a_condition`, `a_city`, `a_descr`, `a_views`, `a_comment`, `a_price`) 
        VALUES (NULL, '$in_user', '$in_title', '$in_tag','$in_cond', '$in_city', '$in_descr', '0', '', '$in_price');";

        if ($mysqli->query($sql) === TRUE) {
            $er = 0;
        } else {
            echo "<div style = \"color: red;\">Error: " . $sql . "<br>" . $mysqli->error."</div>";
        }
    }

    
?>