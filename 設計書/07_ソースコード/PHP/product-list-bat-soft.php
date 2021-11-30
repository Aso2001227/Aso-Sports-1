<?php session_start(); ?>
<?php require 'header.php';?>
<title>Product-list</title>
<?php require 'banner.php';?>
<?php
require_once 'DB_Manager.php';
try{
$pdo=getDB();
$sql=$pdo->prepare('select image from m_items where item_code IN(1,2,3,4)');
$sql->execute();
$resultList=$sql->fetchAll(PDO::FETCH_ASSOC);
$num=1;
    foreach ($resultList as $item) {
        echo '<div class="product',$num,'">';
        echo '<p><img src="', $item['image'], '"></p>';
        echo '</div>';
        $num++;
    }
}catch (PDOException $exception){
    print $exception->getMessage();
}
?>
<?php require 'footer.php';?>