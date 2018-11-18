<?php
    $to = "jester1606@gmail.com";
    $from = "ddme...com";
    $message = "My Сообщение";
    $subject = "My Тема";
    $headers = "From: $from\r\nReply-to: $from\r\nContent-type: text/plain; charset=utf-8\r\n";
    mail($to, $subject, $message, $headers);
?>