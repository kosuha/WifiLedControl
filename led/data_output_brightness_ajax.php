<?php
require('../lib/conn.php');
require('../lib/session.php');
require('../lib/sessionCheck.php'); 

$brightness = $_POST['brightness'];
$id = $_SESSION['id'];

$sqlInsert = "UPDATE ledControl SET brightness = '{$brightness}' WHERE id = '{$id}'";

if($result === false){
    echo mysqli_error($conn);
} else {
    mysqli_query($conn, $sqlInsert);
    echo 'Success!';
}
?>