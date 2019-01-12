<header>
    <div style = "position: relative; width: 100%;">
        <div style ="padding: 5px;" class="logo">
            <a href="../index.php">ANNow</a>
        </div>

        <div style = "position: absolute; right: 10px; width: 75%; margin: 0;">
        <?php
            if($_SERVER['REQUEST_URI'] == "/index.php" || $_SERVER['REQUEST_URI'] == "/")
                $visibility = '';
            else{ 
                $visibility = 'style="visibility: hidden;"';
            }

            comeMessage();

                echo'
                <div '.$visibility.' class = "header-search-block">
                    <button class = "b_advsearch" id = "b_advsearch" onclick = \'advancedSearch();\'>Расширенный поиск</button>
                    <input class = "header-search" type="text" id="search_name" placeholder="Поиск">
                    <i class="fas fa-search"></i>
                </div>';

                if(isset($_SESSION['logged_user'])){
                    $href = "../pages/createAdP.php";
                }else{
                    $href = "../pages/loginP.php?do_create=no";
                }

                echo '
                <div class = "header-button">
                    <a href = "'.$href.'" id="sub_ad"><i class="fas fa-plus-circle"></i> Подать обьявление</a>
                </div>
                ';
            ?>

            <div style ="padding: 10px;"><a href="../index.php">Главная</a></div>

                <?php
                    if(isset($_SESSION['logged_user'])){
                        echo '
                        <div class = "dropdown" style ="padding: 10px;" style= "margin-right: 0px;">
                            <a>Мой кабинет ('.$_SESSION['logged_user']['u_fio'].')</a>
                            <div class="dropdown-menu">
                                <div> <a id="my_cab" href="../pages/My_page.php">Мои объявления</a></div>
                                <div><a href="../pages/favorite-ad.php">Избранное</a></div>
                                <div><a href="../pages/list-dialogs.php">Сообщения</a></div>
                                <div><a href="../index.php?do_logout=logout">Выход</a></div>
                            </div>
                        </div>';
                    }else{
                        echo '
                        <div style ="padding: 10px 0;">
                            <a href="../pages/signupP.php">Регистрация</a>
                        </div>
                        <div style ="padding: 10px 0;">
                            <a href="../pages/loginP.php">Вход</a>
                        </div>';
                    };
                ?>
            </div>
        </div>
    </div>
</header>

<br><br><br><br><br>

<?php
    switch ($_SERVER['REQUEST_URI']){
        case "/pages/detailsAdP.php": { $page = "Подробнее об объявлении"; break;}
        case "/pages/createAdP.php": { $page = "Создание объявления"; break;}
        case "/pages/editAd.php": { $page = "Редактировать объявление"; break;}
        case "/pages/favorite-ad.php": { $page = "Избранные объявления"; break;}
        case "/pages/list-dialogs.php": { $page = "Сообщения"; break;}
        case "/pages/My_page.php": { $page = "Мои объявления"; break;}
    }
    if($page)
        echo '<br><br><div class = "site-navigation">Вы находитесь > <span class = "this-page">'.$page.'</span></div>'
?>