<?php
  require('../lib/conn.php');
  require('../lib/session.php');
  require('../lib/sessionCheck.php'); 

$id = $_SESSION['id'];
$sql = "SELECT * FROM ledControl WHERE id = '{$id}'";
$resultSelect = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($resultSelect);

    echo json_encode(array(
      'res_id'=>$row[1],
      'res_red'=>$row[2],
      'res_green'=>$row[3],
      'res_blue'=>$row[4],
      'res_brightness'=>$row[5],
      'res_num'=>$row[6]
    ));
?>
