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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
</head>
<body>
    <?php
        require_once "../blocks/header.php";
    
        $data = $_POST;
        if(isset($data['do_publish'])){
                echo '<br><p style = "color: green;">Обьявление было успешно опубликовано на <a href = "../index.php">Главную страницу</a></p>';
            }
            else{
            echo '
            <fieldset>
            <legend>Создание обьявления</legend>
                <form action="createAdP.php" method = "POST" enctype="multipart/form-data">
                    <label for = "Заголовок"> *</label>
                    <input autofocus required type="text" name="title"><br>
    
                    <label for = "Категория"> *</label>
                    <select required name="tag">
                        <option value="dress">Одежда</option>
                        <option value="service">Сервис</option>
                        <option value="shoes">Обувь</option>
                    </select><br>
    
                    <label for = "Цена"> *</label>
                    <input pattern = "\d+(,\d{2})?" required type="text" name="price"><br>
    
                    <label for = "Состояние"> *</label>
                    <select required name="condition">
                        <option value="BU">Б/У</option>
                        <option value="new">Новый</option>
                    </select><br>
    
                    <label for = "Описание"> *</label>
                    <textarea style = "resize: none; " required rows="10" cols="60" name="descr" ></textarea><br>
                    
                    <label for = "Фото"> *</label>
                    <input required type="file" id="fileMulti" name="fileMulti[]" multiple accept="image/*" />
                    <div class="row"><span id="outputMulti"></span></div>
    
                    <hr>
                    <label for = "Данные пользователя"> *</label> <br>
                    <input required type="text" name="numTel" placeholder = "Номер телефона"><br>
                    <input required type="text" name="city" placeholder = "Город"><br>
                    <hr>
        
                    <input type="submit" name = "do_publish" value="Опубликовать">
                </form>
            </fieldset>

        ';
        };
    ?>
    
    <br>
    <?php require_once "../blocks/footer.php";?>

</body>
</html>
<script src="../js/createAd.js"></script>