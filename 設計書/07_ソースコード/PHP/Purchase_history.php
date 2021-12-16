<?php session_start(); ?>
<?php require 'header.php';?>
<title>購入履歴</title>
<?php require 'banner.php';?>
<?php
require_once 'DB_Manager.php';
echo '<h2>購入履歴</h2>';
echo '<div class="history">';
if(isset($_SESSION['customer'])){
    $pdo=getDB();
    $sql='select customer_code from t_purchase where customer_code=?';
    $stmt=$pdo->prepare($sql);
    $stmt->bindValue(1,$_SESSION['customer']['customer_code']);
    $stmt->execute();
    while ($row=$stmt->fetch(PDO::PARAM_INT)){
        $code=$row['customer_code'];
    }
    $pdo=null;
    if(isset($code)){
        $sum=0;
        echo '<table border="1">';
        echo '<tr><th> 購入日</th><th > 商品コード</th><th>商品名</th><th>数量</th><th>価格</th><th>代金小計</th ></tr >';
        $sam = 0;
        $pdo2 = getDB();
        $sql='select P.purchase_date as purchase_date,D.item_code as item_code,I.item_name as item_name,D.num as num,I.price as price from t_purchase P,m_items I,t_purchase_detail D where D.purchase_id = P.purchase_id and I.item_code=D.item_code and P.customer_code=?  order by purchase_date,item_code';
        $stmt=$pdo2->prepare($sql);
        $stmt->bindValue(1,$code);
        $stmt->execute();
        while($row=$stmt->fetch(PDO::PARAM_INT)) {
            echo '<tr>';
            echo '<td>', $row['purchase_date'], '</td>';
            echo '<td>', $row['item_code'], '</td>';
            echo '<td>', $row['item_name'], '</td>';
            echo '<td>', $row['num'], '</td>';
            echo '<td>¥', $row['price'], '</td>';
            echo '<td>¥', $row['num'] * $row['price'], '</td>';
            $sum += $row['num'] * $row['price'];
            echo '</tr>';
        }
        echo '<tr><td>商品合計</td><td></td><td></td><td><td></td></td><td>￥', $sum, '</td></tr>';
        echo '</table>';
    }else{
        echo '<h3>購入していません</h3>';
    }
    $pdo2=null;
}else{
    echo 'ログインしてください。';
    echo '<a href="login.php"><button type="button">ログイン</button></a>';
}
echo '</div>';
?>
<?php require 'footer.php';?>

