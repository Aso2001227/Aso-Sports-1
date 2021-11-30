<?php
function getDB(){
    $dsn='mysql:host=mysql146.phy.lolipop.lan; 
        dbname=LAA1291147-system;charset=utf8';
    $username='LAA1291147';
    $pass='abcc0106';
    return new PDO($dsn,$username,$pass);
}
?>
