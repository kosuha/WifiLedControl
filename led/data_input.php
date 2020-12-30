<?php 
require('../lib/session.php');
require('../lib/sessionCheck.php'); 
?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="data_input.css">
    </head>
    <body>
        <div id="nav">
            
            <div id="pwChange_div">
                <a href="../admin/pw_change.php">비밀번호 변경</a>
            </div>
            <?
                if($_SESSION['id'] == "xphobia"){
                    echo "
                    <div id=\"add_div\">
                        <a href=\"../admin/add.php\">계정 추가</a>
                    </div>
                    ";
                }
            ?>
            <!-- <div id="add_div">
                <a href="../admin/add.php">계정 추가</a>
            </div> -->
            <div id="logout_div">
                <a href="../admin/logout.php">로그아웃</a>
            </div>
        </div>
        
        <div class="mid_1">
            <div class="empty_2">&nbsp;</div>
            <div class = "mid_2">
                <div class="empty_3">&nbsp;</div>
                <div class = "mid_3">

                    <div id="picker">

                    </div>

                    <div class="container">
                        <div id="view_id">
                            <?php
                                echo "ID: ".$_SESSION['id'];
                            ?>
                            <!-- ID: xphobia -->
                        </div>
                        <div class="numberContainer">
                            <div>
                                LED number : 
                            </div>
                            <input type="text" class="num" name="num" value="0">
                            <div class="ea">
                                ea
                            </div>
                        </div>
                        <div class="brightnessContainer">
                            <div id="brightnessValue">
                                Brightness : 
                            </div>
                            <input type="range" class="brightness" name="brightness" value="50" min="0" max="100" width="1000px">
                        </div>
                    </div>

                </div>
                <div class="empty_3">&nbsp;</div>
            </div>
            <div class="empty_2">&nbsp;</div>
        </div>
        
        <script type="text/javascript" src="data_input.js"></script>
    </body>
</html>