<?php
    require "../functions/connect.php";
    connectDB();
    require "../functions/editAd.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        $title = "Создание обьявления";
        require_once "../blocks/head.php";
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../js/createAd.js"></script>

</head>
<body>
    <?php
        require_once "../blocks/header.php";
    
        $data = $_POST;

            $ad = findAd("a_id = ".$_GET['updateId']."");
            echo '
            <br>                
            <fieldset class = "createField apper-block" > 
            <h2 class = "createForm-name">Опубликовать объявление</h2>
            <form class = "createForm" action="editAd.php" method = "POST" enctype="multipart/form-data">
                <table class = "input-table">
                    <tr>
                                <td  class = "section"><label>Заголовок <span class= "signRequired">*</span></label></td>
                                <td><input class = "input input-txt" autofocus required type="text" name="title" value = "'.$ad['a_title'].'"><br></td>
                            </tr>

                            <tr>
                                <td class = "section"><label >Категория <span class= "signRequired">*</span></label></td>
                                <td><select id = "tag" class = "input input-select" required name="tag" >
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
                                <td><input class = "input input-txt" pattern = "\d+(,\d{2})?" required type="text" name="price" value = "'.$ad['a_price'].'"><br></td>
                            </tr>

                            <tr>
                                <td style = "text-align: left;" class = "section"><label >Состояние <span class= "signRequired">*</span></label></td>
                                <td><div class="radios-as-buttons">
                                        <div>
                                            <input checked type="radio" name="condition" id="radio1" value = "Новое" />
                                            <label for="radio1">Новое</label>
                                        </div>
                                        <div>
                                            <input type="radio" name="condition" id="radio2" value = "Б/у"/>
                                            <label for="radio2">Б/у</label>
                                        </div>
                                    </div><br></td>
                            </tr>
                            <tr>
                                <td class = "section"><label >Описание <span class= "signRequired">*</span></label></td>
                                <td><textarea class = "input input-desc" style = "resize: none; " required rows="8" cols="55" name="descr" >'.$ad['a_descr'].'</textarea><br></td>
                            </tr>
                            <tr>
                                <td class = "section"><label >Город <span class= "signRequired">*</span></label></td>
                                <td><select class = "input input-select" required name="city" id = "city">
                                    <option value="Харьков">Харьков</option>
                                    <option value="Киев">Киев</option>
                                    <option value="Днипро">Днипро</option>
                                    <option value="Львов">Львов</option>
                                    <option value="Одесса">Одесса</option>
                                    <option value="Винница">Винница</option>
                                    <option value="Чернигов">Чернигов</option>
                                </select><br></td>
                            </tr>
                            <tr>
                                <td class = "section"><label >Фото <span class= "signRequired">*</span></label></td>
                                <td><input class = "input input-file" type="file" id="fileMulti" name="fileMulti[]" multiple accept="image/*" />
                                <div class="row"><span id="outputMulti"></span></div></td>
                            </tr>
                        </table>

                        <input style = "display: none;" type="text" name="id" value = "'.$ad['a_id'].'"><br>
                        <input class = "my-button create-b" type="submit" name = "do_edit" value="Редактировать">
                    </form>
                </fieldset>
                ';
    ?>
    
    <br>
    <?php require_once "../blocks/footer.php";?>

</body>
<script>
        var tag = document.getElementById('tag');
        for(var i = 0; i < tag.childElementCount; i++){
            if(tag.options[i].value == "<?php echo $ad['a_tag']?>")
                tag.options[i].selected = true;
        }

        var city = document.getElementById('city');
        for(var i = 0; i < city.childElementCount; i++){
            if(city.options[i].value == "<?php echo $ad['a_city']?>")
                city.options[i].selected = true;
        }

        var cond = document.getElementsByName('condition');
/*         console.log(cond); */
        for(var i = 0; i < cond.length; i++){
            if(cond[i].value == "<?php echo $ad['a_condition']?>")
                cond[i].checked = true;
        }
</script>
</html>