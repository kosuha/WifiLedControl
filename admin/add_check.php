<?php
    require('../lib/conn.php');

    $id = $_POST['id'];
    $pw = $_POST['pw'];
    $pwagain = $_POST['pwagain'];
 
    $sql = "SELECT * FROM admins WHERE id = '{$id}'";
    $res = $conn->query($sql);

    if($res->num_rows >= 1){
        echo '이미 존재하는 ID입니다.';
    }

    if($pw != $pwagain){
        echo 'PW 확인 필요.';
    }

    if($res->num_rows == 0 && $pw == $pwagain){
        $password = password_hash($pw, PASSWORD_DEFAULT, array('cost' => 12));
        $sql_insert = "INSERT INTO admins(id, pw) VALUES('{$id}', '{$password}')";
        $sql_ledControl = "INSERT INTO ledControl(id, r, g, b, brightness, num) VALUES('{$id}', '0', '0', '0', '0', '0')";

        if($conn->query($sql_insert)){
            if($conn->query($sql_ledControl)){
                $text = "
                    <?php
                        require('../lib/conn.php');
                        \$sql = \"SELECT * FROM ledControl WHERE id = '{$id}'\";
                        \$resultSelect = mysqli_query(\$conn, \$sql);
                        \$row = mysqli_fetch_array(\$resultSelect);
                        \$xml = \"
                        <?xml version='1.0' encoding='UTF-8'?>
                        <led>
                        <color>
                        <r>\".\$row[2].\"</r>
                        <g>\".\$row[3].\"</g>
                        <b>\".\$row[4].\"</b>
                        <brightness>\".\$row[5].\"</brightness>
                        <num>\".\$row[6].\"</num>
                        </color>
                        </led>
                        \";
                        header('Content-type: text/xml');
                        echo \$xml;
                    ";

                $file_name = "../arduinos/".$id.".php";
                file_put_contents($file_name, $text);

                $flag = "등록 완료";
                echo "
                <script>
                alert('{$flag}');
                location.href=\"../led/data_input.php\";
                </script>
                ";
            }
        } else {
            echo '등록실패';
        }
    }

?>
