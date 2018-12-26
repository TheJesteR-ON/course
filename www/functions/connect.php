<?php
    function connectDB(){
        global $mysqli;

        $servername = "localhost";
        $username = "TheJesteRON";
        $password = "Dls2389d";
        $database = "thejester_on";

        $mysqli = new mysqli($servername, $username, $password, $database);
        if($mysqli->connect_error){
            die("Connection failed: " . $mysqli->connect_error);
        }
        session_start();
    }

    function closeDB(){
        global $mysqli;
        $mysqli->close();
    }

/*DataBase END*/ 

/*Регистрация START*/
    

/*END*/

/*Работа с пользователем*/
    
    function findUser($where){ //Поиск (проверка) пользователя при регистрации и авторизации
        global $mysqli;

        $sql = "SELECT * FROM `user` WHERE ".$where.";";
        $result = $mysqli->query($sql);
        return $result->fetch_assoc();
    }

/*END*/  

/*Работа с обьявлением*/

    
    
    function findAd($where){
        global $mysqli;

        $sql = "SELECT * FROM `ad` WHERE ".$where." ";
        $result = $mysqli->query($sql);
        return $result->fetch_assoc();
    }

    function getAd($limit, $where){
        global $mysqli;

        $sql = "SELECT * FROM `ad` WHERE ".$where." ORDER BY `a_id` DESC LIMIT $limit";
        $result = $mysqli->query($sql);
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
        global $mysqli;

        $sql = "SELECT * FROM `dialog` WHERE ".$where."";
        $result = $mysqli->query($sql);
        return resultToArray($result);
    }

    function getMessages($where){
        global $mysqli;

        $sql = "SELECT * FROM `message` WHERE ".$where."";
        $result = $mysqli->query($sql);
        return resultToArray($result);
    }

    function getSql($sql){
        global $mysqli;

        $result = $mysqli->query($sql);
        return resultToArray($result);
    }

    function doQuery($sql){
        global $mysqli;

        $result = $mysqli->query($sql);
        if($result)
            return $result->fetch_assoc();
        else
            return false;
    }

/*END*/
?>