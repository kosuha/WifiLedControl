<?php
    require('../lib/session.php');
    require('../lib/sessionCheck.php'); 

    echo $_SESSION['id'].'님 로그아웃 하겠습니다.';
    unset($_SESSION['id']);

    if($_SESSION['id'] == null){
        header ('Location: access.php');
    }
?>