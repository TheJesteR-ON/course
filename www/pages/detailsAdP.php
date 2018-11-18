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

<?php
    $ad = findAd("a_id = ".$_GET['id']."");
    $user = findUser("u_id = ".$ad['u_id']."");
    echo'
   <div class = "left">
        <img width = "100%" src="../Images/'.$ad['a_id'].'/1.jpg" alt="Статья №'.$ad['a_id'].'"><br>
        <h2>'.$ad['a_title'].'</h3>
        <p>Время публикации: '.$ad['a_time'].'</p>
        <p>Номер объявления: '.$ad['a_id'].'</p>
        <p>Категория: '.$ad['a_tag'].'</p>
        //Состояние
        <p>Описание: '.$ad['a_descr'].'</p>
        <p>Имя пользователя: '.$user['u_fio'].'</p>
        //Другие фото
        //Форма для написания автору
        //Прочие Объявления этого же автора
        <p>Цена: '.$ad['a_price'].'</p>
   </div>';
?>

    <?php require_once "../blocks/footer.php"?>
</body>
</html>