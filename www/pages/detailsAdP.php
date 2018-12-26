<?php
    require "../functions/connect.php";
    connectDB();
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
                <p><h3 class = "detail-block-title">Описание: </h3><br> '.$ad['a_descr'].'</p>
            </div>
            
            //Другие фото
            
            //Прочие Объявления этого же автора
        </div>
        <div class = "right">
            <div class = "apper-block">
                <p><h3 class = "detail-block-title">Цена: </h3><br> '.$ad['a_price'].'</p>
            </div>
            <div class = "apper-block">
                <p><h3 class = "detail-block-title">Имя пользователя: </h3><br> '.$user['u_fio'].'</p>
            </div>
            <div class = "apper-block">
                <p><h3 class = "detail-block-title">Время публикации: </h3><br> '.$ad['a_time'].'</p>
            </div>
            <div class = "apper-block">
                <p><h3 class = "detail-block-title">Город: </h3><br> '.$ad['a_city'].'</p>
            </div>
            <div class = "apper-block">
                <p><h3 class = "detail-block-title">Номер объявления: </h3> '.$ad['a_id'].'</p>
                <p><h3 class = "detail-block-title">Категория: </h3> '.$ad['a_tag'].'</p>
                <p><h3 class = "detail-block-title">Cостояние: </h3> '.$ad['a_condition'].'</p>
            </div>
            ';
            
            if(isset($_SESSION['logged_user'])){
                $dialog = getDialog("`recive` = ".$ad['u_id']." AND `send` = ".$_SESSION['logged_user']['u_id']." OR `recive` = ".$_SESSION['logged_user']['u_id']." AND `send` = ".$ad['u_id']."");
                echo'<a href = "chat.php?dialogId='.$dialog[0]['id'].'">Написать автору объявления</button>';
            }else{
                echo'<a href = "loginP.php">Написать автору объявления</button>';
            }
        echo'
        </div>
            ';
            $ad1 = getad(10, "u_id = ".$ad['u_id']." and a_delete = 'FALSE' and a_id <> ".$ad['a_id']."");
            ?>
    

    <div class="showResult content">
        <table class ="content-table">
            <tr>
            <?php
                for($i = 0; $i < count($ad1); $i++){
                    echo '
                    <td class = "content-block">
                        <a class = "content-a" href = "../pages/detailsAdP.php?id='.$ad1[$i]['a_id'].'">
                            <div>
                                <img class = "content-img" src="../Images/'.$ad1[$i]['a_id'].'/1.jpg" alt="Статья №'.$ad1[$i]['a_id'].'">
                                <div class = "content-block-bottom">
                                    <h3>'.$ad1[$i]['a_title'].'</h3>
                                    <hr>
                                    <p>'.$ad1[$i]['a_price'].'</p>
                                <div>
                            </div>
                        </a>
                    </td>';
                    if(($i + 1) % 4 == 0){
                        echo '</tr> <tr>';
                    }
                }
            ?>
                    
            </tr>
        </table>
    </div>
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