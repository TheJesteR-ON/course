<?php
    require "../functions/connect.php";
    connectDB();
    require "../functions/login.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        $title = "Вход";
        require_once "../blocks/head.php";
    ?>
</head>
<body>
    <?php
        require_once "../blocks/header.php";
    ?>

    <div id="wrapper">
        <form action="loginP.php" id="registration" method = "POST">
            <span id="main_word">Авторизация</span>
            <small>Введите E-mail и пароль</small><br>
            <input autofocus required type="email" name="email" id="email" placeholder="Введите E-mail"><br>
            <input required type="password" name="password" id="password" placeholder="Введите пароль"><br>
            <input type="submit" name = "do_login" value="Войти">

            <a href="signupP.php">Регистрация</a>
        </form>
    </div>

    <br>
    <?php require_once "../blocks/footer.php";?>

</body>
</html>