<?php session_start(); ?>
<?php require 'header.php';?>
    <title>ログイン</title>
<?php require 'banner.php';?>
<?php require 'DB_Manager.php'; $pdo=getDB();?>

    <p><h2>ログイン</h2></p>
    <div class="log">
        <?php
        unset($_SESSION['customer']);
        $sql=$pdo->prepare('select * from m_customers where mail=? and pass=?');
        $sql->execute([$_REQUEST['mail'],$_REQUEST['pass']]);
        foreach ($sql as $row) {
            $_SESSION['customer'] = [
                'customer_code' => $row['customer_code'], 'pass' => $row['pass'], 'name' => $row['name'], 'post_number' => $row['post_number'], 'address' => $row['address'],
                'tel' => $row['tel'], 'mail' => $row['mail'], 'del_flag' => $row['del_flag'], 'reg_date' => $row['reg_date']
            ];
        }
        if (isset($_SESSION['customer'])) {
            echo '<h3>ログインしました</h3>';
            echo '<p>ようこそ', $_SESSION['customer']['name'], '様ようこそ！</p>';
            echo '<p><a href="TopPage.php">トップページへ戻ります。</a></p>';
        } else {
            echo '<h3>ログイン失敗しました　</h3>';
            echo '<p>（メールアドレスかパスワードが間違っています）</p>';
            echo '<p><a href="login.php">ログイン画面に戻ります。</a></p>';
        }
        ?>
    </div>
<?php require 'footer.php';?>