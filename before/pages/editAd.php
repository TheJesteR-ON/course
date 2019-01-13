<?php
    require "../functions/connect.php";
    connectDB();
    require "../functions/editAd.php";

    $types = selectFrom("*", "`types`", " 1");
    

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
                                <td  class = "section"><label>Заголовок </label></td>
                                <td><input class = "input input-txt" autofocus required type="text" name="title" value = "'.$ad['a_title'].'"><br></td>
                            </tr>

                            <tr>
                                <td class = "section"><label >Категория </label></td>
                                <td><select id = "tag" class = "input input-select" required name="tag" >
                                
                                    ';
                                    
                                    for($i = 0; $i < count($types); $i++){
                                        if($ad['a_tag'] == $types[$i]['t_name']){
                                            echo'<option selected value="'.$types[$i]['t_name'].'" onclick = \'showSubtype('.$types[$i]['t_id'].');\'>'.$types[$i]['t_name'].'</option>';
                                            $selected_type_id = $types[$i]['t_id'];
                                        }else{
                                            echo'<option value="'.$types[$i]['t_name'].'" onclick = \'showSubtype('.$types[$i]['t_id'].');\'>'.$types[$i]['t_name'].'</option>';
                                        }
                                    }

                                    echo'
                                </select><br></td>
                            </tr>

                            <tr>
                                <td class = "section"><label >Подкатегория </label></td>
                                <td><select  id = "subtype_list" class = "input input-select" required name="subtag" >
                                ';
                                $subtypes = selectFrom("*", "`subtypes`", "`t_id` = ".$selected_type_id."");

                                for($i = 0; $i < count($subtypes); $i++){
                                    if($ad['a_subtag'] == $subtypes[$i]['st_name']){
                                        echo '<option selected value="'.$subtypes[$i]['st_name'].'">'.$subtypes[$i]['st_name'].'</option>';
                                    }else{
                                        echo '<option value="'.$subtypes[$i]['st_name'].'">'.$subtypes[$i]['st_name'].'</option>';
                                    }
                                }
                                echo'
                                </select><br></td>
                            </tr>

                            <tr>
                                <td class = "section"><label >Цена</label></td>
                                <td><input class = "input input-txt" pattern="[0-9]+(\\.[0-9][0-9]?)?" required type="text" name="price" value = "'.$ad['a_price'].'"><br></td>
                            </tr>

                            <tr>
                                <td style = "text-align: left;" class = "section"><label >Состояние </label></td>
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
                                <td class = "section"><label >Описание </label></td>
                                <td><textarea class = "input input-desc" style = "resize: none; "  rows="8" cols="55" name="descr" >'.$ad['a_descr'].'</textarea><br></td>
                            </tr>
                            <tr>
                                <td class = "section"><label >Город </label></td>
                                <td><select class = "input input-select"  name="city" id = "city">
                                    <option value="Харьков">Харьков</option>
                                    <option value="Киев">Киев</option>
                                    <option value="Днепр">Днепр</option>
                                    <option value="Львов">Львов</option>
                                    <option value="Одесса">Одесса</option>
                                    <option value="Винница">Винница</option>
                                    <option value="Чернигов">Чернигов</option>
                                </select><br></td>
                            </tr>
                            <tr>
                                <td class = "section"><label >Фото </label></td>
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
    
    

    var cond = document.getElementsByName('condition');
/*         console.log(cond); */
    for(var i = 0; i < cond.length; i++){
        if(cond[i].value == "<?php echo $ad['a_condition']?>")
            cond[i].checked = true;
    }

        var city = document.getElementById('city');
        for(var i = 0; i < city.childElementCount; i++){
            if(city.options[i].value == "<?php echo $ad['a_city']?>")
                city.options[i].selected = true;
        }

        function showSubtype(t_id){
        
            $.ajax({url:"/functions/createAd.php?type_id="+t_id, 
            cache:false, 
            dataType: "html",
            success:function(result){
                $('#subtype_list').html(result); //Присвоение HTML-кода в HTML-код элемента
            }
            });
        
        };
        
</script>
<script src="../js/createAd.js"></script>
</html>