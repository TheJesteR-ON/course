<?php
    require "functions/connect.php";
    connectDB();
   

    $data = $_POST;
    //Выход (условие внутри файла)
    require "functions/index.php";

    $ad = getAd(1000, "a_delete = 'FALSE'");
   
    $price = doQuery("SELECT MAX(a_price), MIN(a_price) FROM `ad`");

    $max_price = $price['MAX(a_price)'];
    $min_price = $price['MIN(a_price)'];

    $date = doQuery("SELECT DATE_FORMAT((SELECT MIN(a_time) FROM `ad`), '%Y-%m-%d')");
    $min_date = $date['DATE_FORMAT((SELECT MIN(a_time) FROM `ad`), \'%Y-%m-%d\')'];

    $date = doQuery("SELECT DATE_FORMAT((SELECT MAX(a_time) FROM `ad`), '%Y-%m-%d')");
    $max_date = $date['DATE_FORMAT((SELECT MAX(a_time) FROM `ad`), \'%Y-%m-%d\')'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ANNow: Главная</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/search.js"></script>
    <script src="js/addFavorite.js"></script>
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
            <span>От </span><input type ="number" name="fromprice" id="fromprice" value = "<?php echo($min_price) ?>">
            <span> ДО </span><input type="number" name="toprice" id="toprice" value = "<?php echo($max_price) ?>"><br>

            <h3>Время публикации</h3>
            <span>от </span><input type="date" name="fromtime" id="fromtime"  value = "<?php echo($min_date) ?>">
            <span> до </span><input type="date" name="totime" id="totime" value = "<?php echo($max_date) ?>">
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
                        <i class="fas fa-star" onclick = "addFavorite('.$ad[$i]['a_id'].');"></i>
                        <a class = "content-a" href = "../pages/detailsAdP.php?id='.$ad[$i]['a_id'].'">
                            <div>
                                <img class = "content-img" src="Images/'.$ad[$i]['a_id'].'/1.jpg" alt="Статья №'.$ad[$i]['a_id'].'">
                                <div class = "content-block-bottom">
                                    <h3 class = "content-title">'.$ad[$i]['a_title'].'</h3>
                                    <a class = "content-tag">'.$ad[$i]['a_tag'].'</a>
                                    <a class = "content-city">'.$ad[$i]['a_city'].'</a>
                                    <p class = "content-price">'.$ad[$i]['a_price'].' ₴</p>
                                <div>
                            </div>
                        </a>
                    </td>';
                    if(count($ad) > 1)
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
    function advancedSearch(){
        if(document.getElementById('search-block').style.display == "none"){
            document.getElementById('search-block').style.display = "block";
        }else{
            document.getElementById('search-block').style.display = "none";

            document.getElementById('search_city').options[0].selected = true;
            document.getElementById('tag').options[0].selected = true;

            document.getElementById('fromprice').value = '<? echo $min_price; ?>';
            document.getElementById('toprice').value = '<? echo $max_price; ?>';
            document.getElementById('fromtime').value = '<? echo $min_date; ?>';
            document.getElementById('totime').value = '<? echo $max_date; ?>';

        }
    }
</script>
</html>

