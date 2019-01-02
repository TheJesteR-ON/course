   
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

                $header = "From: jester-on@annow.zzz.com.ua\r\nContent-type: text/html; charset=utf\r\n";
                mail("jester1606@gmail.com", "Security", "".$_SESSION['logged_user']['u_fio']."(".$_SESSION['logged_user']['u_id'].", ".$_SESSION['logged_user']['u_email'].") logs in to ANNOW", $header);

                echo '<script type="text/javascript">window.location.href = "../pages/My_page.php"</script>';
            }
            else{
                //Вывод ошибки
                showMessage("ERROR", array_shift($errors));
            }
        }

        if(isset($_GET['active'])){
            showMessage("INFO", "Активация прошла успешно");
        }

    ?>
   