<?php 
require('../lib/session.php');
require('../lib/sessionCheck.php'); 
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <link rel="stylesheet" href="add.css">
    <link href="https://fonts.googleapis.com/css?family=Yeon+Sung&display=swap&subset=korean" rel="stylesheet">
    <title>LED Control</title>
</head>

<body>
    <div class="empty"></div>
    <div id="pwform">
        <form action="pw_change_check.php" method="post">
            <div id="pw_div">
                <div>변경할 PW: </div>
                <input type="password" name="pw" id="pw">
            </div>
            <div id="pwagain_div">
                <div>변경할 PW 확인: </div>
                <input type="password" name="pwagain" id="pwagain">
            </div>
            <div id="submit_div">
                <input type="submit" value="변경" id="submit">
            </div>
            <div id="access_div">
                <a href="../led/data_input.php">돌아가기</a>
            </div>
        </form>
    </div>
    <div class="empty"></div>
       
  
</body>

</html>