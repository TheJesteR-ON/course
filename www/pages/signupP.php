<?php
    require "../functions/connect.php";
    connectDB();
    require "../functions/signup.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        $title = "Регистрация";
        require_once "../blocks/head.php";
    ?>
</head>
<body>

    <?php
        require_once "../blocks/header.php";
   
    //$data = $_POST;
        if(isset($data['do_signup'])){
            echo '<br><p style = "color: green;">Вам на почту было выслано письмо для подтверждения аккаунта</p>';
        }
        else{
        echo '
        <br>
        <div id="wrapper">
            <form action="signupP.php" method="post" id="registration">
                <span id="main_word">Регистрация</span>
                <small>Введите логин (E-mail) и пароль</small><br>
                <input autofocus required type="text" name="login" id="login" placeholder="Введите Login"><br>
                <input required type="email" name="email" id="email" placeholder="Введите E-mail"><br>
                <input required type="password" name="password" id="password" placeholder="Введите пароль"><br>
                <input required type="password" name="password2" id="password_2" placeholder="Повторите пароль"><br>
                <input type="submit" name = "do_signup" value="Зарегистрироваться на сайте">
            </form>
        </div>
        ';
        };
    ?>
    <br>
    <?php require_once "../blocks/footer.php";?>
</body>
</html>