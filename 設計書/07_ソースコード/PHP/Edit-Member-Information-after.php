<?php session_start();?>
<?require 'header.php';?>
<title>会員情報登録</title>
<?php require 'banner.php';?>
<?php
$pass=$_POST['new_pass'];
if(preg_match('/(?=.*[a-z)(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]{8,}/',$pass)){
    $pdo=new PDO('mysql:host=mysql146.phy.lolipop.lan; 
        dbname=LAA1291147-system;charset=utf8',
        'LAA1291147','abcc0106');
    $sql=$pdo->prepare('update m_customers set pass=?,name=?,post_number=?,address=?,tel=?,mail=? where mail=?');
    $sql->bindValue(1,$_POST['new_pass'],PDO::PARAM_STR);
    $sql->bindValue(2,$_POST['name'],PDO::PARAM_STR);
    $sql->bindValue(3,$_POST['post_number'],PDO::PARAM_STR);
    $sql->bindValue(4,$_POST['address'],PDO::PARAM_STR);
    $sql->bindValue(5,$_POST['tel'],PDO::PARAM_STR);
    $sql->bindValue(6,$_POST['mail'],PDO::PARAM_STR);
    $sql->bindValue(7,$_SESSION['customer']['mail'],PDO::PARAM_STR);
}else{
    echo '<h3>適切なパスワードではありません。</h3>';
}
?>
<?php require 'footer.php';?>
