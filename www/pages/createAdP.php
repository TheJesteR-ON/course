<?php
    require "../functions/connect.php";
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
    
         ?>
    <fieldset class = "createField apper-block" > 
    <h2 class = "createForm-name">Опубликовать объявление</h2>
    <form class = "createForm" action="createAdP.php" method = "POST" enctype="multipart/form-data">
        <table class = "input-table">
            <tr>
                <td  class = "section"><label>Заголовок <span class= "signRequired">*</span></label></td>
                <td><input class = "input-txt input" autofocus required type="text" name="title"><br></td>
            </tr>

            <tr>
                <td class = "section"><label >Категория <span class= "signRequired">*</span></label></td>
                <td><select class = "input-select input" required name="tag">
                    <option value="Мода и стиль">Мода и стиль</option>
                    <option value="Сервис">Сервис</option>
                    <option value="Электроника">Электроника</option>
                    <option value="Животные">Животные</option>
                    <option value="Недвижимость">Недвижимость</option>
                    <option value="Транспорт">Транспорт</option>
                    <option value="Работа">Работа</option>
                    <option value="Хобби, отдых и спорт">Хобби, отдых и спорт</option>
                </select><br></td>
            </tr>

            <tr>
                <td class = "section"><label >Цена <span class= "signRequired">*</span></label></td>
                <td><input class = "input-txt input" pattern = "\d+(,\d{2})?" required type="text" name="price"><br></td>
            </tr>

            <tr>
                <td style = "text-align: left;" class = "section"><label >Состояние <span class= "signRequired">*</span></label></td>
                <td><div class="radios-as-buttons">
                        <div>
                            <input checked type="radio" name="condition" id="radio1" value = "Новое" checked />
                            <label for="radio1">Новое</label>
                        </div>
                        <div>
                            <input type="radio" name="condition" id="radio2" value = "Б/у"/>
                            <label  for="radio2">Б/у</label>
                        </div>
                    </div><br></td>
            </tr>
            <tr>
                <td class = "section"><label >Описание <span class= "signRequired">*</span></label></td>
                <td><textarea class = "input input-desc" style = "resize: none; " required rows="8" cols="55" name="descr" ></textarea><br></td>
            </tr>
            <tr>
                <td class = "section"><label >Город <span class= "signRequired">*</span></label></td>
                <td><select class = "input-select input" required name="city">
                    <option value="Харьков">Харьков</option>
                    <option value="Киев">Киев</option>
                    <option value="Днепр">Днипро</option>
                    <option value="Львов">Львов</option>
                    <option value="Одесса">Одесса</option>
                    <option value="Винница">Винница</option>
                    <option value="Чернигов">Чернигов</option>
                </select><br></td>
            </tr>
            <tr>
                <td class = "section"><label >Фото <span class= "signRequired">*</span></label></td>
                <td><input class = "input-file input" required type="file" id="fileMulti" name="fileMulti[]" multiple accept="image/*" />
                <div class="row"><span id="outputMulti"></span></div></td>
            </tr>
        </table>

        <input class = "my-button create-b" type="submit" name = "do_publish" value="Опубликовать">
    </form>
</fieldset>

    <br>    

</body>
<script src="../js/createAd.js"></script>
</html>
