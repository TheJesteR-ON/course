<?php
    $data = $_GET;
    if(isset($data['do_logout'])){
        closeDB();
        unset($_SESSION['logged_user']);
        session_abort();
    }
    if(isset($_GET['name'])){
        require "connect.php";

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
                    $f_ad = selectFrom("*", "`favorite_ad`", "`a_id` = ".$ad[$i]['a_id']." AND `u_id` = ".$_SESSION['logged_user']['u_id']."");
                    $style = "";
                    if($f_ad){
                        $style = "style = \"background-color: #2fbdb4;\"";
                    }
                    echo '
                    <td class = "content-block">
                        <i class="fas fa-star" '.$style.'  id = "i-'.$ad[$i]['a_id'].'" onclick = \'addFavorite('.$ad[$i]['a_id'].');\'></i>
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
            require_once "../blocks/no_ad.php";
        }
                    
    }
    
    if(isset($_POST['ad_favorite'])){
        require "connect.php";

        $ad = selectFrom("*", "`favorite_ad`", "`a_id` = ".$_POST['ad_favorite']." AND `u_id` = ".$_SESSION['logged_user']['u_id']."");

        if(!$ad){
            insertInto("`favorite_ad`", "`a_id`, `u_id`", "".$_POST['ad_favorite'].", ".$_SESSION['logged_user']['u_id']."");
            echo 'add';
        }
        else{
            delete("`favorite_ad`",  "`a_id` = ".$_POST['ad_favorite']." AND `u_id` = ".$_SESSION['logged_user']['u_id']."");
            echo 'delete';
        }
        
        closeDB();
    }
?>