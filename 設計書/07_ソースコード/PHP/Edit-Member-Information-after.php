<?php session_start();?>
<?php require 'header.php';?>
<title>会員情報登録</title>
<?php require 'banner.php';?>
<?php
require 'DB_Manager.php';
$pdo=getDB();
if($_POST['mail']!=$_SESSION['customer']['mail']) {
    $sql='select customer_code from m_customers where mail= :mail';
    $stmt=$pdo->prepare($sql);
    $stmt->bindValue(':mail',$_POST['mail']);
    $stmt->execute();
    while($row=$stmt->fetch(PDO::PARAM_INT)){
        $id=$row['customer_code'];
    }
    $pdo=null;
}
?>
<?php
if(empty($id)) {
    $pdo2=getDB();
    if (preg_match('/(?=.*[a-z)(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]{8,}/', $_POST['new_pass'])) {
        $sql2=$pdo2->prepare('update m_customers set pass=?,name=?,post_number=?,address=?,tel=?,mail=? where mail=?');
        $sql2->bindValue(1, $_POST['new_pass'], PDO::PARAM_STR);
        $sql2->bindValue(2, $_POST['name'], PDO::PARAM_STR);
        $sql2->bindValue(3, $_POST['post_number'], PDO::PARAM_STR);
        $sql2->bindValue(4, $_POST['address'], PDO::PARAM_STR);
        $sql2->bindValue(5, $_POST['tel'], PDO::PARAM_STR);
        $sql2->bindValue(6, $_POST['mail'], PDO::PARAM_STR);
        $sql2->bindValue(7, $_SESSION['customer']['mail'], PDO::PARAM_STR);
        $sql2->execute();
        echo '<h3>編集が完了しました</h3>';
        $pdo2=null;
    } else {
        echo '<h3>適切なパスワードではありません。</h3>';
    }
}else{
    echo '<h3 id="err">既に登録されているメールアドレスです。</h3>';
}
?>
<?php require 'footer.php';?>
