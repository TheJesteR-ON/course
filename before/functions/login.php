   
    <?php
     /*Авторизация*/
        $data = $_POST;
        if(isset($data['do_login'])){
            //Вход

            $user = findUser("u_email like '".$data['email']."'");
            if($user){
                if(!password_verify($data['password'], $user['u_password'])){
                    $errors[] = "Введен неверный пароль!";
                }

                if($user['activation'] <> ''){
                    $errors[] = "Аккаунт не активирован!";
                }

            }
            else{
                $errors[] = "Не найдено пользователя с таким E-mail!";
            }

            
            if(empty($errors)){
                //Если нет ошибок
                $_SESSION['logged_user'] = $user;

                $header = "From: jester-on@annow.kl.com.ua\r\nContent-type: text/html; charset=utf\r\n";
                mail("jester1606@gmail.com", "Security", "LOGIN: ".$_SESSION['logged_user']['u_fio']."\nID: ".$_SESSION['logged_user']['u_id']."\nMAIL: ".$_SESSION['logged_user']['u_email'].")\n IS ONLINE", $header);

                echo '<script type="text/javascript">window.location.href = "../pages/My_page.php?checkMyAd=1"</script>';
            }
            else{
                //Вывод ошибки
                showMessage("ERROR", array_shift($errors));
            }
        }

        if(isset($_GET['active'])){
            showMessage("INFO", "Активация прошла успешно");
        }
        if(isset($_GET['do_send'])){
            showMessage("INFO", "Для отправки сообщений следует ввойти в аккаунт пользователя");
        }
        if(isset($_GET['do_create'])){
            showMessage("INFO", "Для публикации обьявления следует ввойти в аккаунт пользователя");
        }
              

    ?>
   