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
<br><br><br>
    <div class="log-block">
        <div class="log-name">Авторизация</div><br>
        <form style = "margin: 0 auto; width: 90%;" class = "log-form" action="loginP.php" id="registration" method = "POST">
            <img style = "margin: 20px auto 20px" width = "100px" src="../Images/user_orange.png" alt="#">
            <input class = "reg-input" autofocus required type="email" name="email" id="email" placeholder="Введите E-mail"><br>
            <input class = "reg-input" required type="password" name="password" id="password" placeholder="Введите пароль"><br>
            <input class = "reg-button log-button" type="submit" name = "do_login" value="Войти">

            <p>Если у вас нет аккаунта, вам следует <a href="signupP.php">зарегистрироваться</a><p>
        </form>
    </div>

    <br>
    <?php require_once "../blocks/footer.php";?>

</body>
</html>