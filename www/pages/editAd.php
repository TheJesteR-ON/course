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
        if(isset($data['do_edit'])){
            echo '<div class = "content-block" style = "color: green;">Обьявление было успешно отредактировано на <a href = "../index.php">Главную страницу</a></div>';
        }
        else if(isset($_GET['updateId'])){
            $ad = findAd("a_id = ".$_GET['updateId']."");
            echo '
            <br>                
                <fieldset class = "createField" > 
                    <h2 class = "createForm-name">Опубликовать объявление</h2>
                    <form class = "createForm" action="editAd.php" method = "POST" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td  class = "section"><label>Заголовок <span class= "signRequired">*</span></label></td>
                                <td><input class = "input" autofocus required type="text" name="title" value = "'.$ad['a_title'].'"><br></td>
                            </tr>

                            <tr>
                                <td class = "section"><label >Категория <span class= "signRequired">*</span></label></td>
                                <td><select id = "tag" class = "input" required name="tag" >
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
                                <td><input class = "input" pattern = "\d+(,\d{2})?" required type="text" name="price" value = "'.$ad['a_price'].'"><br></td>
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
                                            <label for="radio2">Б/у</label>
                                        </div>
                                    </div><br></td>
                            </tr>
                            <tr>
                                <td class = "section"><label >Описание <span class= "signRequired">*</span></label></td>
                                <td><textarea class = "input" style = "resize: none; " required rows="8" cols="55" name="descr" >'.$ad['a_descr'].'</textarea><br></td>
                            </tr>
                            <tr>
                                <td class = "section"><label >Город <span class= "signRequired">*</span></label></td>
                                <td><select class = "input" required name="city" id = "city">
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
                                <td><input class = "input" required type="file" id="fileMulti" name="fileMulti[]" multiple accept="image/*" />
                                <div class="row"><span id="outputMulti"></span></div></td>
                            </tr>
                        </table>

                        <input style = "display: none;" type="text" name="id" value = "'.$ad['a_id'].'"><br>
                        <input class = "action-button" type="submit" name = "do_edit" value="Опубликовать">
                    </form>
                </fieldset>
                ';
        };
    ?>
    
    <br>
    <?php require_once "../blocks/footer.php";?>

</body>
<script>
    function(){
        var tag = document.getElementById('tag');
        for(var i = 0; i < tag.options.count(); i++){
            if(tag.options[i].value == "<?php echo $ad['a_tag']?>")
                document.getElementById('tag').options[i].selected = true;
        }


        var city = document.getElementById('city');
        for(var i = 0; i < city.options.count(); i++){
            if(city.options[i].value == "<?php echo $ad['a_city']?>")
                document.getElementById('city').options[i].selected = true;
        }
    }
</script>
</html>