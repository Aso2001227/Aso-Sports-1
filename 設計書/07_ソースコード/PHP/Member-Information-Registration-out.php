<?php require 'header.php';?>
<title>会員情報登録</title>
<?php require 'banner.php';?>
<?php
$reg='<a href="http://aso2001195.perma.jp/test2/Member-Information-Registration.php">登録画面に戻ります。</a>';
require 'DB_Manager.php';
$pdo=getDB();
$pdo2=getDB();
$sql='select customer_code from m_customers where mail= :mail';
$stmt=$pdo->prepare($sql);
$stmt->bindValue(':mail',$_POST['mail']);
$stmt->execute();
while ($row=$stmt->fetch(PDO::PARAM_INT)){
    $id=$row['customer_code'];
}
$pdo=null;
?>
<?php
$tel=$_POST['tel']; $post=$_POST['post_number'];
$telchk=false; $postchk=false;
if(preg_match('/^[0][0-9]{1,20}$/',$tel)){
    $telchk=true;
}
if(preg_match('/^[0-9]{7}$/',$post)){
    $postchk=true;
}
if($telchk && $postchk){
    if (!isset($id)) {
        if (preg_match('/(?=.*[a-z)(?=.*[A-Z])(?=.*[0-9])[a-zA-Z0-9]{8,}/', $_POST['pass'])) {
            $today = date("Y-m-d H:i:s");
            $sql2 = $pdo2->prepare('INSERT INTO m_customers(pass,name,post_number,address,tel,mail,reg_date) VALUES(?,?,?,?,?,?,?)');
            $sql2->bindValue(1, $_POST['pass'], PDO::PARAM_STR);
            $sql2->bindValue(2, $_POST['name'], PDO::PARAM_STR);
            $sql2->bindValue(3, $post, PDO::PARAM_STR);
            $sql2->bindValue(4, $_POST['address'], PDO::PARAM_STR);
            $sql2->bindValue(5, $tel, PDO::PARAM_STR);
            $sql2->bindValue(6, $_POST['mail'], PDO::PARAM_STR);
            $sql2->bindValue(7, $today, PDO::PARAM_STR);
            $sql2->execute();
            echo '<h3>会員情報が登録されました。</h3>';
            echo '<p><a href="TopPage.php">トップページへ戻ります。</a></p>';
        } else {
            echo '<h3>適切なパスワードではありません</h3>';
            echo $reg;
        }
    }else{
        echo '<h3 id="err">既に登録されているメールアドレスです。</h3>';
    }
}else if($postchk){
    echo '<h3>電話番号に数字以外を入力しないでください</h3>';
    echo $reg;
}else if($telchk){
    echo '<h3>郵便番号に数字以外を入力しないでください</h3>';
    echo $reg;
}else{
    echo '<h3>電話番号、郵便番号に数字以外を入力しないでください</h3>';
    echo $reg;
}
?>
<?php require 'footer.php';?>
