<?php
    require "../functions/connect.php";
    connectDB();
    require "../functions/createAd.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        $title = "Создание обьявления";
        require_once "../blocks/head.php";
    ?>
</head>
<body>
    <?php
        require_once "../blocks/header.php";
    
        $data = $_POST;
        if(isset($data['do_publish']) || isset($data['do_edit'])){
                echo '<br><p style = "color: green;">Обьявление было успешно опубликовано на <a href = "../index.php">Главную страницу</a></p>';
            }
            else{
                if(isset($_GET['updateId'])){
                    $ad = findAd("a_id = ".$_GET['updateId']."");
                    echo '
        <br>
        <fieldset>
            <legend>Редактировать обьявление</legend>
                <form action="createAdP.php" method = "POST" enctype="multipart/form-data">
                    Загловок
                    <input autofocus required type="text" name="title" value = "'.$ad['a_title'].'"><br>
                    Категория
                    <select required name="tag">
                        <option value="dress">Одежда</option>
                        <option value="service">Сервис</option>
                        <option value="shoes">Обувь</option>
                    </select><br>
                    Цена
                    <input required type="text" name="price" value = "'.$ad['a_price'].'"><br>
                    Описание
                    <input required type="text" name="descr" value = "'.$ad['a_descr'].'"><br>
                    Фото
                    <input required type="file" name="userfile"><br>

                    <input style = "display: none;" type="text" name="id" value = "'.$ad['a_id'].'"><br>

                    <input type="submit" name = "do_edit" value="Редактировать">
                </form>
            </fieldset>';
                }
                else{
            echo '
        <br>
        <fieldset>
            <legend>Создание обьявления</legend>
                <form action="createAdP.php" method = "POST" enctype="multipart/form-data">
                    Загловок
                    <input autofocus required type="text" name="title"><br>
                    Категория
                    <select required name="tag">
                        <option value="dress">Одежда</option>
                        <option value="service">Сервис</option>
                        <option value="shoes">Обувь</option>
                    </select><br>
                    Цена
                    <input required type="text" name="price"><br>
                    Описание
                    <input required type="text" name="descr"><br>

                    Фото
                    <input required type="file" name="userfile"><br>
                    
                    <input type="submit" name = "do_publish" value="Опубликовать">
                </form>
            </fieldset>';
        };}
    ?>
    <br>
    <?php require_once "../blocks/footer.php";?>

</body>
</html>