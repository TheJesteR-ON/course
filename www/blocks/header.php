    <header>
    <div>
        <a href="../index.php"><span id="main_letter">AN</span>Now</a>
    </div>
    <?php
        if(isset($_SESSION['logged_user'])){
            echo '
            <div class = "dropdown">
                <a>Мой кабинет</a>
                <div class="dropdown-menu">
                    <a id="my_cab" href="../pages/My_page.php">Мои объявления</a>
                    <a href="../index.php">Главная</a>
                    <form action="../index.php" method="post">
                        <input class = "dropdown-exit" type="submit" name = "do_logout" value="Выход">
                    </form>
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
    <div id = "right">
        <?php
            if(isset($_SESSION['logged_user'])){
                echo '
                <a>'.$_SESSION['logged_user']['u_fio'].'</a>
                <a class = "action-button" href = "../pages/createAdP.php" id="sub_ad">Подать обьявление</a>
                ';
            }else{
                echo '<a class = "action-button" href = "../pages/loginP.php" id="sub_ad">Подать обьявление</a>';
            }
        ?>
    </div>
</header>
    <br>