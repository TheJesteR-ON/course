<header>
    <div style = "position: relative; width: 100%;">
        <div style ="padding: 5px;" class="logo">
            <a href="../index.php">ANNow</a>
        </div>

        <div style = "position: absolute; right: 0; width: 70%; margin: 0;">
            <div class = "header-search-block">
                <button class = "b_advsearch" id = "b_advsearch" onclick = 'advancedSearch();'>Расширенный поиск</button>
                <input class = "header-search" type="text" id="search_name">
                <img class = "search-img" width="25px" src="../Images/search.png" alt="Поиск">
            </div>

            <?php
                if(isset($_SESSION['logged_user'])){
                    echo '
                    <div class = "header-button">
                        <a href = "../pages/createAdP.php" id="sub_ad">Подать обьявление</a>
                    </div>
                    ';
                }else{
                    echo '<div class = "header-button">
                            <a href = "../pages/loginP.php" id="sub_ad">Подать обьявление</a>
                        </div>';
                }
            ?>

            <div style ="padding: 10px;"><a href="../index.php">Главная</a></div>

                <?php
                    if(isset($_SESSION['logged_user'])){
                        echo '
                        <div class = "dropdown" style ="padding: 10px;" style= "margin-right: 0px;">
                            <a>Мой кабинет ('.$_SESSION['logged_user']['u_fio'].')</a>
                            <div class="dropdown-menu">
                                <div> <a id="my_cab" href="../pages/My_page.php">Мои объявления</a></div>
                                <div><a href="../index.php">Главная</a></div>
                                <div><a href="../index.php">Избранное</a></div>
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
