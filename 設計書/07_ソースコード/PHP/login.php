<?php session_start(); ?>
<?php require 'header.php';?>
    <title>ログイン</title>
<?php require 'banner.php';?>
    <p><h2>ログイン</h2></p>
    <div class="log">
        <form action="login-out.php" method="post">
            <p>メールアドレス</p>
            <input type="email" name="mail">
            <p>パスワード</p>
            <input type="password" name="pass">
            <input type="submit" name="action_button" value="ログイン">
            <a href="Member-Information-Registration.php">登録されてない方はこちら</a>
        </form>
    </div>
<?php require 'footer.php';?>