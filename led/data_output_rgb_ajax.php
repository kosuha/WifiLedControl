<?php
require('../lib/conn.php');
require('../lib/session.php');
require('../lib/sessionCheck.php'); 

$r = $_POST['r'];
$g = $_POST['g'];
$b = $_POST['b'];
$id = $_SESSION['id'];

$sqlInsert = "UPDATE ledControl SET r = '{$r}', g = '{$g}', b = '{$b}' WHERE id = '{$id}'";

if($result === false){
    echo mysqli_error($conn);
} else {
    mysqli_query($conn, $sqlInsert);
    echo 'Success!';
}
?>