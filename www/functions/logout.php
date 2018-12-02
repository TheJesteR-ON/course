<?php
    $data = $_GET;
    if(isset($data['do_logout'])){
            unset($_SESSION['logged_user']);
            echo '<script type="text/javascript">window.location.href = "../index.php"</script>';
        }
?>