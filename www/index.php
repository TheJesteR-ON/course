<?php
    require "functions/connect.php";
    connectDB();

    $data = $_POST;
    //Выход (условие внутри файла)
    require "functions/index.php";

    $ad = getAd(1000, "a_delete = 'FALSE'");
    $min_price = doQuery("SELECT a_price")   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ANNow: Главная</title>
    <link rel="stylesheet" href="css/index.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/search.js"></script>
</head>
<body>
    <?php
        require_once "blocks/header.php";
    ?>

    <br>
    <div class = "search-block" id = "search-block">
        <form class = "search-form" id="advancedSearch">
            <h3>Местоположение</h3>
            <select class = "search-item" name="location" id="search_city">
                <option value=""></option>
                <option value="Харьков">Харьков</option>
                <option value="Киев">Киев</option>
                <option value="Днипро">Днипро</option>
                <option value="Львов">Львов</option>
                <option value="Одесса">Одесса</option>
                <option value="Винница">Винница</option>
                <option value="Чернигов">Чернигов</option>   
            </select>
            <h3>Категория</h3>
            <select  class = "search-item" name="tag" id="tag">
                <option value=""></option>
                <option value="Мода и стиль">Мода и стиль</option>
                <option value="Сервис">Сервис</option>
                <option value="Электроника">Электроника</option>
                <option value="Животные">Животные</option>
                <option value="Недвижимость">Недвижимость</option>
                <option value="Транспорт">Транспорт</option>
                <option value="Работа">Работа</option>
                <option value="Хобби, отдых и спорт">Хобби, отдых и спорт</option>
            </select>
            <h3>Цена</h3>
            <span>От </span><input type ="text" name="fromprice" id="fromprice">
            <span> ДО </span><input type="text" name="toprice" id="toprice"><br>

            <h3>Время публикации</h3>
            <span>от </span><input type="time" name="fromtime" id="fromtime">
            <span> до </span><input type="time" name="totime" id="fromtime">
        </form>
        <br>
    </div>
    
    <div class="showResult content">
        <table class ="content-table">
            <tr class = "content-row">
            <?php
                for($i = 0; $i < count($ad); $i++){
                    echo '
                    <td class = "content-block">
                        <a class = "content-a" href = "../pages/detailsAdP.php?id='.$ad[$i]['a_id'].'">
                            <div>
                                <img class = "content-img" src="Images/'.$ad[$i]['a_id'].'/1.jpg" alt="Статья №'.$ad[$i]['a_id'].'">
                                <div class = "content-block-bottom">
                                    <h3>'.$ad[$i]['a_title'].'</h3>
                                    <hr>
                                    <p>'.$ad[$i]['a_price'].'</p>
                                <div>
                            </div>
                        </a>
                    </td>';
                    if((($i + 1) % round(count($ad)/5) == 0)||(($i + 1) == count($ad))){
                        echo '</tr> <tr class = "content-row">';
                    }
                }
            ?>
                    
            </tr>
        </table>
    </div>
    
    <br>
    <?php require_once "blocks/footer.php";?>

</body>
<script>
    boolean i = false;
    $('#b_advsearch').click(function(){
        if(i){
            $('#search-block').show('slow');
            i = true;
        }
        else{
            $('#search-block').hide('slow');
            i = false;
        }
    });
</script>
</html>

