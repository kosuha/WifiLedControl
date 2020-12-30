<?php
    require('../lib/session.php');
    require('../lib/conn.php');

    $id = $_POST['id'];
    $pw = $_POST['pw'];
 
    $sql = "SELECT * FROM admins WHERE id = '{$id}'";
    $res = $conn->query($sql);
    $row = $res->fetch_array(MYSQLI_ASSOC);

    
    $password = $row['pw'];
    

    if ($row != null) {
        if ( password_verify($pw, $password)) {
            $_SESSION['id'] = $id;
            header ('Location: ../led/data_input.php');
            } else {
                $flag = "접근거부 : PW 가 일치하지 않습니다.";
                echo "
                <script>
                alert('{$flag}');
                location.href=\"access.php\";
                </script>
                ";
            }
       }

    if($row == null){
        $flag = "접근거부 : ID 가 일치하지 않습니다.";
        echo "
        <script>
        alert('{$flag}');
        location.href=\"access.php\";
        </script>
        ";
    }
?>
