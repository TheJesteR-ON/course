<?php
    require "../functions/connect.php";
    connectDB();
    require "../functions/My_page.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        $title = "Мой кабинет";
        require_once "../blocks/head.php";
    ?>
</head>
<body>
   <?php require_once "../blocks/header.php";?>
   <table class = "my-content-table">
   <?php
    $ad = getAd(100, "u_id = ".$_SESSION['logged_user']['u_id']."");
    
    
    for($i = 0; $i < count($ad); $i++){
            $date = getThisDate($ad[$i]['a_time']);
            $time = getThisTime($ad[$i]['a_time']);
            echo '
            <tr class = "content-block my-content-block">
            <td class = "my-content-img">
                <a href = "../pages/detailsAdP.php?id='.$ad[$i]['a_id'].'">
                    <img src="../Images/'.$ad[$i]['a_id'].'/1.jpg" alt="Статья №'.$ad[$i]['a_id'].'"><br>
                </a>
            </td>
            <td class = "my-content-info">
                <h2 class = "content-title">'.$ad[$i]['a_title'].'</h3>
                <a class = "content-city">'.$ad[$i]['a_city'].'</a>
                <a class = "content-tag">'.$ad[$i]['a_tag'].'</a><br>
                <a class = "content-tag">'.$date.' '.$time.'</a>
                <p class = "content-price">'.$ad[$i]['a_price'].' ₴</p>
            </td>
            <td class = "my-content-buttons">
                <form action="My_page.php" method="post">
                    <input type = "text" name = "deleteId" value = "'.$ad[$i]['a_id'].'" style ="display: none;">
                    <input class = "my-button " type = "submit" name = "do_edit" value = "Редактировать"><br>
                    <input class = "my-button " type = "submit" name = "do_delete" value = "Деактивировать"><br>
                    <input class = "my-button" type = "submit" name = "do_really_delete" value = "Удалить">
                </form><br>
            </td>
            </tr><br>';
    }
   ?> 
    </table>    
    <?php require_once "../blocks/footer.php"?>
</body>
</html>