<?require 'header.php';?>
<title>会員情報登録</title>
<?php require 'banner.php';?>
<?php
require 'DB_Mamager.php';
$pdo=getDB();
$pdo2=getDB();
$sql='select customer_code from m_customers where mail= :mail';
$stmt=$pdo->prepare($sql);
$stmt->bindValue(':mail',$_POST['mail']);
$stmt->excute();
while ($row=$stmt->fetch(PDO::PARAM_INT)){
    $id=$row['customer_code'];
}
$pdo=null;


?>
<?php
if (empty($id)) {
    if (preg_match('/(?=.*[a-z)(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]{8,}/', $_POST['pass'])) {
        $today = date("Y-m-d H:i:s");
        $sql2 = $pdo2->prepare('INSERT INTO m_customers(pass,name,post_number,address,tel,mail,reg_date) VALUES(?,?,?,?,?,?,?)');
        $sql2->bindValue(1, $_POST['pass'], PDO::PALAM_STR);
        $sql2->bindValue(2, $_POST['name'], PDO::PALAM_STR);
        $sql2->bindValue(3, $_POST['post_number'], PDO::PALAM_STR);
        $sql2->bindValue(4, $_POST['address'], PDO::PALAM_STR);
        $sql2->bindValue(5, $_POST['tel'], PDO::PALAM_STR);
        $sql2->bindValue(6, $_POST['mail'], PDO::PALAM_STR);
        $sql2->bindValue(7, $today, PDO::PALAM_STR);
        $sql2->execute();
        echo '<h3>会員情報が登録されました。</h3>';
        echo '<p><a href="TopPage.php">トップページへ戻ります。</a></p>';
    } else {
        echo '<h3>適切なパスワードではありません</h3>';
    }
}else{
    echo '<h3 id="err">既に登録されているメールアドレスです。</h3>';
}
?>
<?php require 'footer.php';?>
