<?php
    require "../functions/connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        $title = "Избранное";
        require_once "../blocks/head.php";
    ?>
</head>
<body>
   <?php require_once "../blocks/header.php";?>
   
   <?php
    $f_ad = selectFrom("*", "`favorite_ad`", "`favorite_ad`.`u_id` = ".$_SESSION['logged_user']['u_id']."");
    
    if($f_ad){
        echo'
        <table class = "my-content-table">
        <caption class = "table-caption">Избранные объявления</caption>';
        for($i = 0; $i < count($f_ad); $i++){
            $ad = findAd("a_id = ".$f_ad[$i]['a_id']."");

            $date = getThisDate($ad['a_time']);
            $time = getThisTime($ad['a_time']);
            echo '
            <tr class = "content-block my-content-block">
            <td class = "my-content-img">
                <a href = "../pages/detailsAdP.php?id='.$ad['a_id'].'">
                    <img src="../Images/'.$ad['a_id'].'/1.jpg" alt="Статья №'.$ad['a_id'].'"><br>
                </a>
            </td>
            <td class = "my-content-info" style="width: 80%;">
                <h2 class = "content-title">'.$ad['a_title'].'</h3>
                <a class = "content-tag"><i class="fas fa-tags"></i> '.$ad['a_tag'].'</a>
                <a class = "content-city"><i class="fas fa-map-marker-alt"></i> '.$ad['a_city'].'</a><br>
                <p class = "content-tag"><i class="far fa-clock"></i> '.$date.' '.$time.'</p>
                <p class = "content-price">'.$ad['a_price'].' ₴</p>
            </td>
            </tr><br>';
        }
        echo'</table>';
    }
    else{
        require_once "../blocks/no_ad.php";
        echo'<p style = "font-size: 18px; text-align: center;">Для использования данной страницы следует сначала пометить объявления как избранные</p>';
    }
   ?> 
     
    <?php require_once "../blocks/footer.php"?>
</body>
</html>