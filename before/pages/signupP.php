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
        echo '
        <br>
        <div id="wrapper">
            <form action="signupP.php" method="post" id="registration">
                <table class = "reg-table">
                    <tr>
                        <td class = "reg-left">
                            <img style = "margin: 40px 0 0px" width = "100px" src="../Images/user-icon.png" alt="#">
                            <div id="reg-name">Регистрация</div>
                        </td>
                        <td class = "reg-right">
                            <input class = "reg-input" autofocus required type="text" name="login" id="login" placeholder="Введите Login"><br>
                            <input class = "reg-input" required type="email" name="email" id="email" placeholder="Введите E-mail"><br>
                            <input class = "reg-input" required type="password" name="password" id="password" placeholder="Введите пароль"><br>
                            <input class = "reg-input" required type="password" name="password2" id="password_2" placeholder="Повторите пароль"><br>
                            <input class = "reg-button" type="submit" name = "do_signup" value="Зарегистрироваться">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        ';
    ?>
    <br>
    <?php require_once "../blocks/footer.php";?>
</body>
</html>