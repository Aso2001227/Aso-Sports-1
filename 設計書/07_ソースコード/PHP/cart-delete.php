<?php session_start();?>
<?php require 'header.php';?>
<title>cart-delete</title>
<?php require 'banner.php';?>
<h2 id="center">カート削除</h2>
<?php

unset($_SESSION['product'][$_REQUEST['item_code']]);
echo '<p>カートから商品を削除しました。</p>';
echo '<a href="cart.php"><button type="button">カートに戻る</button></a>';
?>
<?php require 'footer.php';?>
