
    <?php
        $data = $_POST;
        if(isset($data['do_signup'])){
            //Регистрация

            if(trim($data['login']) == ''){
                $errors[] = 'Введите логин!';
            }

            if(trim($data['email']) == ''){
                $errors[] = 'Введите Email!';
            }

            if($data['password'] == ''){
                $errors[] = 'Введите пароль!';
            }

            if($data['password'] != $data['password2'] ){
                $errors[] = 'Повторный пароль введен неверно!';
            }

            $user = findUser("`u_fio` like '".$data['login']."'");
            if($user){
                $errors[] = 'Пользователь с таким логином уже существуюет!';
            }

            $user = findUser("`u_email` like '".$data['email']."'");
            if($user){
                $errors[] = 'Пользователь с таким E-mail уже существуюет!';
            }

            if(empty($errors)){
                //Если нет ошибок
                saveUser($data['login'], $data['email'], password_hash($data['password'], PASSWORD_DEFAULT));
                //echo '<div style="color: green;">Вам на почту выслано письмо-подтверждения аккаунта!</div><hr>';
            }
            else{
                //Вывод ошибки
                echo '<div style="color: red;">'.array_shift($errors).'</div><hr>';
            }
        }
        
        //Активация
        if(isset($_GET['login']) && isset($_GET['key'])){
            $login = $_GET['login'];
            $key = $_GET['key'];
            if(checkActivateLink($login, $key)){
                activateUser($login);
                echo '<script type="text/javascript">window.location.href = "../pages/loginP.php?active=activation"</script>';
            }else{
                echo '<div style = "color: red;">Активация провалена</div>';
            }
        }


        function saveUser($in_login, $in_email, $in_password){
            global $mysqli;
    
            $activation = getActivateLink($in_login);
            $sql = "INSERT INTO `user` (`u_id`, `u_fio`, `u_email`, `u_password`,`activation`, `u_numtel`, `u_adres`)
            VALUES (NULL, '$in_login', '$in_email', '$in_password','$activation' , '', '');";
            $mysqli->query($sql);
    
            mail("$in_email", "Registration", "annow.zzz.com.ua/pages/signupP.php?login=$in_login&key=$activation");
        }
    
        function getActivateLink($login){ //Создание кода активации для ссылки
            $secret = "Danil";
            return md5($secret.$login);
        }
    
        function checkActivateLink($in_login, $key){//Сравнение кода активации с почты и с БД
            $real_key = getActivateLinkFromTable($in_login);
            return $real_key === $key;
        }
    
        function getActivateLinkFromTable($login){//Получение кода активации с БД
            global $mysqli;
            $row = findUser("`u_fio` = '$login'"); 
            return $row['activation'];
        }
    
        function activateUser($login){
            global $mysqli;
    
            $result_set = $mysqli->query("UPDATE `user` SET `activation` = '' WHERE `u_fio` = '$login'");
        }
        

    ?>
    