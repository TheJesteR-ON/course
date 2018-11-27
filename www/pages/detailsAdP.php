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
        <p>Cостояние: '.$ad['a_condition'].'</p>
        <p>Описание: '.$ad['a_descr'].'</p>
        <p>Имя пользователя: '.$user['u_fio'].'</p>
        //Другие фото
        
        <p>Цена: '.$ad['a_price'].'</p>
        //Прочие Объявления этого же автора
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

    <?php require_once "../blocks/footer.php"?>
</body>
</html>