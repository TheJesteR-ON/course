<?php
    require "../functions/connect.php";
    connectDB();
    require "../functions/details.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        $title = "Объявление";
        require_once "../blocks/head.php";
    ?>
</head>
<body>
   <?php require_once "../blocks/header.php";?>

<div class = "detail-main">
    <?php
        addView();
        $ad = findAd("a_id = ".$_GET['id']."");
        $user = findUser("u_id = ".$ad['u_id']."");

        echo'
        <div class = "left">
            <div class = "detail-photo apper-block">
                <img id = "mainPhoto" width = "100%" src="../Images/'.$ad['a_id'].'/1.jpg" alt="Статья №'.$ad['a_id'].'"><br>
            ';
            for($i = 1; $i < 6; $i++){
                echo'
                <img id = "'.$i.'" width = "50px" src="../Images/'.$ad['a_id'].'/'.$i.'.jpg" onclick = \'changePhoto(this.id)\'>
                ';
            }
            echo'
            </div>
            
            <div class = "detail-descr apper-block">
                <h2 class = "detail-title">'.$ad['a_title'].'</h2>
                <h3 class = "detail-block-title">Описание: </h3>
                <p> '.$ad['a_descr'].'</p>
            </div>
            
            //Другие фото
            
            //Прочие Объявления этого же автора
        </div>
        <div class = "right">
            <div class = "apper-block">
                <p><h3 class = "detail-block-title">Цена: </h3><br> <span class = "content-price">'.$ad['a_price'].' ₴</span></p>
            </div>
            <div class = "apper-block">
                <p><h3 class = "detail-block-title">Имя пользователя: </h3><br> '.$user['u_fio'].'</p>
            </div>
            <div class = "apper-block">
                <p><h3 class = "detail-block-title">Время публикации: </h3><br> '.getThisDate($ad['a_time']).' '.getThisTime($ad['a_time']).'</p>
            </div>
            <div class = "apper-block">
                <p><h3 class = "detail-block-title">Город: </h3><br> '.$ad['a_city'].'</p>
            </div>
            <div class = "apper-block">
                <p><h3 class = "detail-block-title">Номер объявления: </h3> '.$ad['a_id'].'</p>
                <p><h3 class = "detail-block-title">Категория: </h3> '.$ad['a_tag'].'</p>
                <p><h3 class = "detail-block-title">Cостояние: </h3> '.$ad['a_condition'].'</p>
                <p><h3 class = "detail-block-title">Количество просмотров: </h3> '.$ad['a_views'].'</p>
            </div>
            ';
            
            if(isset($_SESSION['logged_user'])){
                $action = "detailsAdP.php";
            }else{
                $action = "loginP.php";
            }


        echo'
                <form action = "'.$action.'" style = "text-align: center;" method = "get">
                    <input type = "text" style = "display: none;" name = "user_id" value = "'.$ad['u_id'].'" />
                    <input type = "submit" name = "do_send" class = "my-button" style = "margin: auto; padding: 15px; width: 90%; font-size: 18px; text-align: center;" value = "Написать автору объявления"/>
                </form>
        </div>
            ';
            $ad1 = getad(10, "u_id = ".$ad['u_id']." and a_delete = 'FALSE' and a_id <> ".$ad['a_id']."");
            ?>
    
        <table class = "my-content-table">
            <?php
                for($i = 0; $i < count($ad1); $i++){
                    echo '
                    <tr class = "content-block my-content-block">
                    <td class = "my-content-img">
                        <a href = "../pages/detailsAdP.php?id='.$ad1[$i]['a_id'].'">
                            <img src="../Images/'.$ad1[$i]['a_id'].'/1.jpg" alt="Статья №'.$ad1[$i]['a_id'].'"><br>
                        </a>
                    </td>
                    <td class = "my-content-info" style = "width: 80%">
                        <h2 class = "content-title">'.$ad1[$i]['a_title'].'</h3>
                        <a class = "content-city">'.$ad1[$i]['a_city'].'</a>
                        <a class = "content-tag">'.$ad1[$i]['a_tag'].'</a>
                        <p class = "content-price">'.$ad1[$i]['a_price'].' ₴</p>
                    </td>
                    </tr><br>';
                }
            ?>   
        </table>
            </div>
    <?php require_once "../blocks/footer.php"?>
</body>
<script>
    function changePhoto(id)
    {
        document.getElementById("mainPhoto").src = document.getElementById(id).src;
    }
</script>
</html>