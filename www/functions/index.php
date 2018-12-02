<?php
    
    if(isset($_GET['search_name'])){
        require "connect.php";
        connectDB();
                    
        $ad = getAd(10, "a_title like '%".$_GET['search_name']."%' AND a_delete = 'FALSE'");

        echo'<table class ="content-table">
            <tr>';
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
            echo '
            </tr>
        </table>
        ';
    }
?>