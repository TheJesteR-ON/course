<?php
    require "functions/connect.php";
    connectDB();
   

    $data = $_POST;
    //Выход (условие внутри файла)
    require "functions/index.php";

    $ad = getAd(1000, "a_delete = 'FALSE' ORDER BY `a_views` DESC");

    $types = selectFrom("*", "`types`", " 1");
    $subtypes = selectFrom("*", "`subtypes`", "`t_id` = 1");
   
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
    <script src="../js/createAd.js"></script>
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
                <option value="Днепр">Днипро</option>
                <option value="Львов">Львов</option>
                <option value="Одесса">Одесса</option>
                <option value="Винница">Винница</option>
                <option value="Чернигов">Чернигов</option>
                  
            </select>
            <h3>Категория</h3>
            <select  class = "search-item" name="tag" id="tag">
                <option value=""></option>
<?php
                for($i = 0; $i < count($types); $i++){
                    echo'<option value="'.$types[$i]['t_name'].'" onclick = \'showSubtype('.$types[$i]['t_id'].');\'>'.$types[$i]['t_name'].'</option>';
                }
?>
            </select>

            <h3>Подкатегория</h3>
            <select  class = "search-item" name="subtag" id = "subtype_list">
                <option value=""></option>
<?php
                
                for($i = 0; $i < count($subtypes); $i++){
                        echo '<option value="'.$subtypes[$i]['st_name'].'">'.$subtypes[$i]['st_name'].'</option>';
                }
?>
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

    <h3>Сортировка</h3>
    <select id = "sorting-list">
        <option id = "reset" value = "`a_views` DESC">Популярные</option>
        <option value = "`a_price` ASC">От дешевых к дорогим</option>
        <option value = "`a_price` DESC">От дорогих к дешевым</option>
        <option value = "`a_time` DESC">Новые</option>
    </select>
    
    <div class="showResult content">
        <table class ="content-table" id ="content-table">
            <tr class = "content-row">
            <?php
                for($i = 0; $i < count($ad); $i++){
                    $f_ad = selectFrom("*", "`favorite_ad`", "`a_id` = ".$ad[$i]['a_id']." AND `u_id` = ".$_SESSION['logged_user']['u_id']."");
                    $style = "";
                    if($f_ad){
                        $style = "style = \"background-color: #2fbdb4;\"";
                    }
                    if(isset($_SESSION['logged_user']) == FALSE){
                        $style = "style = \"display: none;\"";
                    }
                    echo '
                    <td class = "content-block">
                        <i class="fas fa-star" '.$style.'  id = "i-'.$ad[$i]['a_id'].'" onclick = \'addFavorite('.$ad[$i]['a_id'].');\'></i>
                        <a class = "content-a" href = "../pages/detailsAdP.php?id='.$ad[$i]['a_id'].'">
                            <div>
                                <img class = "content-img" src="Images/'.$ad[$i]['a_id'].'/1.jpg" alt="Статья №'.$ad[$i]['a_id'].'">
                                <div class = "content-block-bottom">
                                    <h3 class = "content-title">'.$ad[$i]['a_title'].'</h3>
                                    <a class = "content-tag"><i class="fas fa-tags"></i> '.$ad[$i]['a_tag'].'</a><br>
                                    <p class = "content-city"><i class="fas fa-map-marker-alt"></i> '.$ad[$i]['a_city'].'</p>
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
            document.getElementById('subtype_list').options[0].selected = true;
            

            document.getElementById('fromprice').value = '<? echo $min_price; ?>';
            document.getElementById('toprice').value = '<? echo $max_price; ?>';
            document.getElementById('fromtime').value = '<? echo $min_date; ?>';
            document.getElementById('totime').value = '<? echo $max_date; ?>';

        }
    }
</script>
</html>

