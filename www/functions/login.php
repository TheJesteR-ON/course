   
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
                echo '<script type="text/javascript">window.location.href = "../pages/My_page.php"</script>';
            }
            else{
                //Вывод ошибки
                echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
            }
        }

        if(isset($_GET['active'])){
            echo '<p style = "color: green;">Активация прошла успешно</p>';
        }

    ?>
   