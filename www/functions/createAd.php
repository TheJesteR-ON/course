<?php
    $data = $_POST;
    if(isset($data['do_publish'])){
        publishAd($data);
    }
    if(isset($data['do_edit'])){
        editAd($data);
    }
    if(isset($_GET['img'])){
        $count = 0;
        foreach ($_FILES['userfile']['name'] as $filename) 
        {
            $imagePath = $_FILES['userfile']['tmp_name'][$count]. $_FILES['userfile']['name'][$count];
            $count = $count + 1;

            echo '<img height = "150px" src="'.$imagePath.'">';
        }
    }

    function publishAd($data){
        saveAd($_SESSION['logged_user']['u_id'], $data['title'], $data['tag'],$_SESSION['logged_user']['u_adres'], $data['descr'], $data['price']);

        $ad = findAd("a_id = (Select MAX(a_id) from ad)"); //Нахождение максимального индекса для создания папки в дальнейшем

        mkdir("../Images/".$ad['a_id']."");

        /*
        $uploadfile = "../Images/".$ad['a_id']."/1.jpg";

        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            $er = 0;
        } else {
            echo "Возможная атака с помощью файловой загрузки!<br>";
        } 
        */

        $count = 0;
        foreach ($_FILES['userfile']['name'] as $filename) 
            {
                $tmp = $_FILES['userfile']['tmp_name'][$count];
                $count = $count + 1;
                $temp = "../Images/".$ad['a_id']."/".$count.".jpg";
                move_uploaded_file($tmp, $temp);
                $temp = '';
                $tmp = '';
            }
    }

    function saveAd($in_user, $in_title, $in_tag, $in_city, $in_descr, $in_price){
        global $mysqli;

        $sql = "INSERT INTO `ad` (`a_id`, `u_id`, `a_title`, `a_tag`, `a_city`, `a_descr`, `a_views`, `a_comment`, `a_price`) 
        VALUES (NULL, '$in_user', '$in_title', '$in_tag', '$in_city', '$in_descr', '0', '', '$in_price');";

        if ($mysqli->query($sql) === TRUE) {
            $er = 0;
        } else {
            echo "<div style = \"color: red;\">Error: " . $sql . "<br>" . $mysqli->error."</div>";
        }
    }

    function editAd($data){
        global $mysqli;
        $result_set = $mysqli->query("UPDATE `ad` SET `a_title` = '".$data['title']."', `a_descr` = '".$data['descr']."', `a_price` = '".$data['price']."'  WHERE `a_id` = '".$data['id']."'");
    }
?>