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
                  
    <fieldset class = "createField" > 
    <h2 class = "createForm-name">Опубликовать объявление</h2>
    <form class = "createForm" action="createAdP.php" method = "POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td  class = "section"><label>Заголовок <span class= "signRequired">*</span></label></td>
                <td><input class = "input" autofocus required type="text" name="title"><br></td>
            </tr>

            <tr>
                <td class = "section"><label >Категория <span class= "signRequired">*</span></label></td>
                <td><select class = "input" required name="tag">
                    <option value="dress">Одежда</option>
                    <option value="service">Сервис</option>
                    <option value="shoes">Обувь</option>
                </select><br></td>
            </tr>

            <tr>
                <td class = "section"><label >Цена <span class= "signRequired">*</span></label></td>
                <td><input class = "input" pattern = "\d+(,\d{2})?" required type="text" name="price"><br></td>
            </tr>

            <tr>
                <td style = "text-align: left;" class = "section"><label >Состояние <span class= "signRequired">*</span></label></td>
                <td><div class="radios-as-buttons">
                        <div>
                            <input checked type="radio" name="option" id="radio1" checked />
                            <label for="radio1">Новое</label>
                        </div>
                        <div>
                            <input type="radio" name="option" id="radio2" />
                            <label for="radio2">Б/у</label>
                        </div>
                    </div><br></td>
            </tr>
            <tr>
                <td class = "section"><label >Описание <span class= "signRequired">*</span></label></td>
                <td><textarea class = "input" style = "resize: none; " required rows="8" cols="55" name="descr" ></textarea><br></td>
            </tr>
            <tr>
                <td class = "section"><label >Фото <span class= "signRequired">*</span></label></td>
                <td><input class = "input" required type="file" id="fileMulti" name="fileMulti[]" multiple accept="image/*" />
                <div class="row"><span id="outputMulti"></span></div></td>
            </tr>
        </table>
        <hr>
        <label class = "createForm-name">Данные пользователя <span class= "signRequired">*</span></label> <br>
        <input class = "input" required type="text" name="numTel" placeholder = "Номер телефона"><br>
        <input class = "input" required type="text" name="city" placeholder = "Город"><br>
        <hr>

        <input type="submit" name = "do_publish" value="Опубликовать">
    </form>
</fieldset>
        ';}
        ?>
    <br>
    <?php require_once "../blocks/footer.php"?>

</body>
<script src="../js/createAd.js"></script>
</html>
