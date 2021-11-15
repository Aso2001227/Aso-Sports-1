<?php require 'header.php';?>
<title>ログアウト</title>
<?php require 'banner.php';?>
<div id="log">
<?php
session_start();
$_SESSION = array();
if (isset($_COOKIE['PHPSESSID'])) {
    setcookie('PHPSESSID','', time() - 1800,'/');
    echo 'ログアウトしました';
}
session_destroy();

echo '<a href="TopPage.php">トップページへ戻ります。</a>';
?>
</div>
<?php require 'footer.php';?>
