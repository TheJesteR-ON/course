<?php
    require "functions/connect.php";
    connectDB();

    $data = $_POST;
    //Выход (условие внутри файла)
    require "functions/index.php";

    $ad = getAd(10, "a_delete = 'FALSE'");       
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
    <form id="target">
        <input type="text" name="search" id="search_name">
    </form>
    <br>
    
    <div class="showResult content">
        <table class ="content-table">
            <tr>
            <?php
                for($i = 0; $i < count($ad); $i++){
                    echo '
                    <td class = "content-block">
                        <div>
                            <a href = "../pages/detailsAdP.php?id='.$ad[$i]['a_id'].'">
                                <div class = "img-back">
                                    <img height = "150px" src="Images/'.$ad[$i]['a_id'].'/1.jpg" alt="Статья №'.$ad[$i]['a_id'].'"><br>
                                </div>
                                <h2>'.$ad[$i]['a_title'].'</h3>
                            </a>
                            <p>'.$ad[$i]['a_price'].'</p>
                        </div>
                    </td>';
                    if(($i + 1) % 5 == 0){
                        echo '</tr> <tr>';
                    }
                }
            ?>
            </tr>
        </table>
    </div>
    
    <br>
    <?php require_once "blocks/footer.php";?>

</body>
</html>

