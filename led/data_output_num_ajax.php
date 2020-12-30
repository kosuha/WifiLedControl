<?php
require('../lib/conn.php');
require('../lib/session.php');
require('../lib/sessionCheck.php'); 

$num = $_POST['num'];
$id = $_SESSION['id'];

$sqlInsert = "UPDATE ledControl SET num = '{$num}' WHERE id = '{$id}'";

if($result === false){
    echo mysqli_error($conn);
} else {
    mysqli_query($conn, $sqlInsert);
    echo 'Success!';
}
?>