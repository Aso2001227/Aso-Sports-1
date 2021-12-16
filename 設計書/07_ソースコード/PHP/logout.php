<?php
session_start();
if(isset($_SESSION['customer_code'])) {
    $_SESSION = array();
    if (isset($_COOKIE['PHPSESSID'])) {
        setcookie('PHPSESSID', '', time() - 1800, '/');
    }
    session_destroy();
}
?>
<?php require 'header.php';?>
<title>ログアウト</title>
<?php require 'banner.php';?>
<div class="log">
<?php
if(isset($_SESSION['customer_code'])) {
    echo '<h3>ログアウトしました</h3>';
    echo '<p><a href="TopPage.php">トップページへ戻ります。</a></p>';
}else{
    echo '<h3>既にログアウト状態です。</h3>';
    echo '<a href="http://aso2001195.perma.jp/test2/login.php">ログインする</a>';
}
?>
</div>
<?php require 'footer.php';?>
