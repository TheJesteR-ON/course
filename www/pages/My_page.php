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
    
    for($i = 0; $i < count($ad); $i++){
            echo '
            <div style = "border: 1px solid grey;">
                <a href = "../pages/detailsAdP.php?id='.$ad[$i]['a_id'].'">
                    <img width = "200px" src="../Images/'.$ad[$i]['a_id'].'/1.jpg" alt="Статья №'.$ad[$i]['a_id'].'"><br>
                    <h2>'.$ad[$i]['a_title'].'</h3>
                </a>
                <a href = "../pages/createAdP.php?updateId='.$ad[$i]['a_id'].'">Редактировать </a>
                <form action="My_page.php" method="post">
                    <input type = "text" name = "deleteId" value = "'.$ad[$i]['a_id'].'" style ="display: none;">
                    <input type = "submit" name = "do_delete" value = "Удалить">
                </form><br>
                <p>'.$ad[$i]['a_price'].'</p>
            </div><br>';
    }
   ?> 

    <?php require_once "../blocks/footer.php"?>
</body>
</html>