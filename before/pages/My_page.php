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
   
   
   <?php
    $ad = getAd(100, "u_id = ".$_SESSION['logged_user']['u_id']."");
    
    if($ad){
    echo'
    <table class = "my-content-table">
    <caption class = "table-caption">Мои объявления</caption>';
    for($i = 0; $i < count($ad); $i++){
            $date = getThisDate($ad[$i]['a_time']);
            $time = getThisTime($ad[$i]['a_time']);

            $active_button['name'] = "do_delete";
            $active_button['value'] = "Деактивировать";
            if($ad[$i]['a_delete'] == 1){
                $active_button['name'] = "do_active";
                $active_button['value'] = "Aктивировать";
            }


            echo '
            <tr class = "content-block my-content-block">
            <td class = "my-content-img">
                <a href = "../pages/detailsAdP.php?id='.$ad[$i]['a_id'].'">
                    <img src="../Images/'.$ad[$i]['a_id'].'/1.jpg" alt="Статья №'.$ad[$i]['a_id'].'"><br>
                </a>
            </td>
            <td class = "my-content-info">
                <h2 class = "content-title">'.$ad[$i]['a_title'].'</h3>
                <a class = "content-tag"><i class="fas fa-tags"></i> '.$ad[$i]['a_tag'].'</a>
                <a class = "content-city"><i class="fas fa-map-marker-alt"></i> '.$ad[$i]['a_city'].'</a><br>
                <p class = "content-tag"><i class="far fa-clock"></i> '.$date.' '.$time.'</p>
                <a class = "content-tag"><i class="far fa-eye"></i> '.$ad[$i]['a_views'].'</a>
                
                <p class = "content-price">'.$ad[$i]['a_price'].' ₴</p>
            </td>
            <td class = "my-content-buttons">
                <form action="My_page.php" method="post">
                    <input type = "text" name = "deleteId" value = "'.$ad[$i]['a_id'].'" style ="display: none;">
                    <input class = "my-button " type = "submit" name = "do_edit" value = "Редактировать"><br>
                    <input class = "my-button " type = "submit" name = "'.$active_button['name'].'" value = "'.$active_button['value'].'"><br>
                    <input class = "my-button" type = "submit" name = "do_really_delete" value = "Удалить">
                </form><br>
            </td>
            </tr><br>
             ';
    }
    echo'</table>';
    }
    else{
        if(isset($_GET['checkMyAd'])){
            echo '<script type="text/javascript">window.location.href = "../index.php"</script>';
        }
        require_once "../blocks/no_ad.php";
        showMessage("INFO", "Для использования данной страницы следует сперва опубликовать собственное объявление");
    }
   ?> 
       
    <?php require_once "../blocks/footer.php"?>
</body>
</html>