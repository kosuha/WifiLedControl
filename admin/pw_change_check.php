<?php
    require('../lib/conn.php');
    require('../lib/session.php');
    require('../lib/sessionCheck.php'); 

    $id = $_SESSION['id'];
    $pw = $_POST['pw'];
    $pwagain = $_POST['pwagain'];

    if($pw != $pwagain){
        echo 'PW 확인 필요.';
    }
    
    //접속코드를 암호화 처리
    $password = password_hash($pw, PASSWORD_DEFAULT, array('cost' => 12));

    //데이터베이스에 저장
    $sql = "UPDATE admins SET pw = '{$password}' WHERE id = '{$id}'";

    if($conn->query($sql) && $pw == $pwagain){
        unset($_SESSION['id']);
        $flag = "변경 완료";
            echo "
            <script>
            alert('{$flag}');
            location.href=\"access.php\";
            </script>
            ";
    } else {
        $flag = "변경 실패";
            echo "
            <script>
            alert('{$flag}');
            location.href=\"pw_change.php\";
            </script>
            ";
    }
    
?>
