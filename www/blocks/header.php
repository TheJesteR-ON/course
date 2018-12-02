    <header>
    <div style ="padding: 10px;" class="logo">
        <a href="../index.php">ANNOW</a>
    </div>

    <div class = "header-search-block">
        <input class = "header-search" type="text">
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
                <a>Мой кабинет</a>
                <div class="dropdown-menu">
                    <div> <a id="my_cab" href="../pages/My_page.php">Мои объявления</a></div>
                    <div><a href="../index.php">Главная</a></div>
                    <div><a href="../functions/logout.php?do_logout=logout">Выход</a></div>
                </div>
            </div>';
        }else{
            echo '
            <div>
                <a href="../pages/signupP.php">Регистрация</a>
            </div>
            <div>
                <a href="../pages/loginP.php">Вход</a>
            </div>';
        };
    ?>
       
</header>
    <br>