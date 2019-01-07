<?php
    $data = $_GET;
    if(isset($data['do_logout'])){
        unset($_SESSION['logged_user']);
    }
    if(isset($_GET['name'])){
        require "connect.php";
        connectDB();

                    
        $ad = getAd(10000, "a_title like '%".$_GET['name']."%' 
        AND a_city like '%".$_GET['city']."%' 
        AND a_tag like '%".$_GET['tag']."%' 
        AND a_price >= ".$_GET['fprice']." 
        AND a_price <= ".$_GET['tprice']."
        AND (DATE(a_time) between '".$_GET['fdate']."' AND '".$_GET['tdate']."')
        AND a_delete = 'FALSE'");

        if($ad){
            echo'
            <table class ="content-table">
            <tr class = "content-row">';
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
                  echo'  
            </tr>
        </table>';
        }else{
            echo'<img width = "500px;" src = "Images/no_ad.png">';
        }
                    
    }
    
    if(isset($_POST['ad_favorite'])){
        require "connect.php";
        connectDB();

        if(insertInto("`favorite_ad`", "`a_id`, `u_id`", "".$_POST['ad_favorite'].", ".$_SESSION['logged_user']['u_id'].""))
            showMessage("INFO", "Обьявление добавлено в избранные");
        else{
            showMessage("ERROR", "Обьявление не было добавлено в избранные");
        }
        
        closeDB();
    }
?>