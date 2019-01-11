<?php
    function connectDB(){
        global $mysqli;

        $servername = "localhost";
        $username = "TheJesteRON";
        $password = "Dls2389d";
        $database = "thejester_on";

        /*$servername = "localhost";
        $username = "id7916279_thejesteron";
        $password = "Dls2389d";
        $database = "id7916279_thejester_on";*/

        $mysqli = new mysqli($servername, $username, $password, $database);
        if($mysqli->connect_error)
            die("Connection failed: " . $mysqli->connect_error);

        session_start();
    }

    function closeDB(){
        
        global $mysqli;
        $mysqli->close();
    }

/*DataBase END*/ 

/*Работа с пользователем*/
    
    function findUser($where){ //Поиск (проверка) пользователя при регистрации и авторизации
        connectDB();
        global $mysqli;
        
        $sql = "SELECT * FROM `user` WHERE ".$where.";";
        $result = $mysqli->query($sql);
        
        if($result == TRUE)
            return $result->fetch_assoc();
        else
            return FALSE;
        closeDB();
    }

    
    
    function findAd($where){
        connectDB();
        global $mysqli;

        $sql = "SELECT * FROM `ad` WHERE ".$where." ";
        $result = $mysqli->query($sql);
        closeDB();
        if($result == TRUE)
            return $result->fetch_assoc();
        else
            return FALSE;

        
    }

    function getAd($limit, $where){
        connectDB();
        global $mysqli;

        $sql = "SELECT * FROM `ad` WHERE ".$where." ORDER BY `a_id` DESC LIMIT $limit";
        $result = $mysqli->query($sql);
        closeDB();
        if($result == TRUE)
            return resultToArray($result);
        else
            return FALSE;

        
    }

    function resultToArray($result){
        $array = array();
        while (($row = $result->fetch_assoc()) != false)
            $array[] = $row;
        return $array;
    }

    function getDialog($where){
        connectDB();
        global $mysqli;

        $sql = "SELECT * FROM `dialog` WHERE ".$where."";
        $result = $mysqli->query($sql);
        closeDB();
        if($result == TRUE)
            return resultToArray($result);
        else
            return FALSE;
        
            
    }

    function getMessages($where){
        connectDB();
        global $mysqli;

        $sql = "SELECT * FROM `message` WHERE ".$where."";
        $result = $mysqli->query($sql);
        closeDB();
        if($result == TRUE)
            return resultToArray($result);
        else
            return FALSE;

            
    }

    function getSql($sql){
        connectDB();
        global $mysqli;

        $result = $mysqli->query($sql);
        closeDB();
        if($result == TRUE)
            return resultToArray($result);
        else
            return FALSE;

            
    }

    function doQuery($sql){
        connectDB();
        global $mysqli;

        $result = $mysqli->query($sql);
        closeDB();
        if($result)
            return $result->fetch_assoc();
        else
            return false;

            
    }

/*END*/

function sendMessage($userId, $message){
    connectDB();
    global $mysqli;

     if($userId == $_SESSION['logged_user']['u_id']){
        $errors[] = "Отправка сообщение самому себе невозможна!";
    }else{
        $dialog = mysqli_query($mysqli,"SELECT * FROM `dialog` WHERE `recive` = ".$userId." AND `send` = ".$_SESSION['logged_user']['u_id']." OR `recive` = ".$_SESSION['logged_user']['u_id']." AND `send` = ".$userId."");
        //$dialog = selectFrom("*", "`dialog`","`recive` = ".$userId." AND `send` = ".$_SESSION['logged_user']['u_id']." OR `recive` = ".$_SESSION['logged_user']['u_id']." AND `send` = ".$userId."");

        $dialog = $dialog->fetch_assoc();
        if($dialog){
            $dialog_id = $dialog['id'];
            mysqli_query($mysqli,"UPDATE `dialog` SET `status` = 0, `send` = ".$_SESSION['logged_user']['u_id'].", `recive` = ".$userId." WHERE `id` = $dialog_id");
        }else{
            mysqli_query($mysqli,"INSERT INTO `dialog` VALUES ('', 0, ".$_SESSION['logged_user']['u_id'].", ".$userId.")");
            $dialog_id = mysqli_insert_id($mysqli);
        }
        
        if(empty($errors)){
            //Если нет ошибок
            $mysqli->query("INSERT INTO `message` VALUES ('', ".$dialog_id.", ".$_SESSION['logged_user']['u_id'].", '$message', NOW())");
        }
        else{
            //Вывод ошибки
            showMessage("ERROR", array_shift($errors));
            
        } 
    }
    closeDB();
}

function getThisTime($dateTime){
    $date = new DateTime(''.$dateTime.'');
    return $date->format("H:i");
}

function getThisDate($dateTime){
    $date = new DateTime(''.$dateTime.'');
    return $date->format("d.m.Y");
}
function showMessage($type, $errors){
    if($type == "ERROR")
        $type = "<i class=\"fas fa-exclamation-triangle\"></i>";
    else
        $type = "<i class=\"fas fa-info-circle\"></i>";
    echo"<script>
            document.getElementById('message-block').innerHTML = '".$type." ".$errors."';
            document.getElementById('message-block').style.display='block';
        </script>";
}
function comeMessage(){
    global $mysqli;
    $message = selectFrom("*", "`dialog`", "`status` = 0 AND `recive` = ".$_SESSION['logged_user']['u_id']."");
    if($message)
    showMessage("INFO", "У вас есть ".count($message)." непрочитанные сообщение(ий)");
}
echo '
    <div id = "message-block">
    </div>
';

function insertInto($table, $columns, $values){
    connectDB();
    global $mysqli;
    $result = mysqli_query($mysqli, "INSERT INTO ".$table." (".$columns.") VALUES (".$values.")");

    closeDB();
    if($result){
        return true;
    }else{
        return $mysqli->error;
    }
}
function update($table, $set, $where){
    connectDB();
    global $mysqli;
    $result = mysqli_query($mysqli, "UPDATE ".$table." SET ".$set." WHERE ".$where."");
    closeDB();

    if($result){
        return true;
    }else{
        return false;
    }
}
function delete($table, $where){
    connectDB();
    global $mysqli;

    $result = mysqli_query($mysqli, "DELETE FROM ".$table." WHERE ".$where."");
    closeDB();
    if($result){
        return TRUE;
    }else{
        return FALSE;
    }


}
function selectFrom($columns, $tables, $where){
    connectDB();
    global $mysqli;

    $sql = "SELECT ".$columns." FROM ".$tables." WHERE ".$where."";
    $result = $mysqli->query($sql);
    closeDB();
    if($result == TRUE)
        return resultToArray($result);
    else
        return FALSE;

        
}
?>