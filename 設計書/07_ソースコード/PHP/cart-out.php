<?php session_start(); ?>
<?php require 'header.php';?>
<title>cart</title>
<?php require 'banner.php';?>
<?php
require_once 'DB_Manager.php';
$customer_code=$_POST['customer_code'];
$total=$_POST['total'];
$today = date("Y-m-d");
try {
    $pdo = getDB();
    $sql = 'select purchase_date,total_price,purchase_id from t_purchase where customer_code=? and purchase_date=?';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $customer_code);
    $stmt->bindValue(2, $today);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::PARAM_INT)) {
        $date = $row['purchase_date'];
        $total_price = $row['total_price'];
        $id = $row['purchase_id'];
    }
    $pdo = null;
}catch (PDOException $PDOException){
    echo "エラー：" . $PDOException->getMessage();
}
?>
<?php
$pdo3=getDB();
if(!(isset($date))) {
        try {
            $sql = $pdo3->prepare('insert into t_purchase(customer_code,purchase_date,total_price) values(?,?,?)');
            $sql->bindValue(1, $customer_code);
            $sql->bindValue(2, $today);
            $sql->bindValue(3, $total);
            $sql->execute();
            $pdo3 = null;
        }catch (Exception $PDOException){
            echo "エラー：" . $PDOException->getMessage();
        }
        $pdo5=getDB();
        try {
            $sql2 = 'select purchase_id from t_purchase where customer_code=? and purchase_date=?';
            $stmt4 = $pdo5->prepare($sql2);
            $stmt4->bindValue(1,$customer_code);
            $stmt4->bindValue(2,$today);
            $stmt4->execute();
            while ($row = $stmt4->fetch(PDO::PARAM_INT)) {
                $id = $row['purchase_id'];
            }
        }catch (PDOException $PDOException){
            echo "エラー：" . $PDOException->getMessage();
        }
}else{
    $sum=$total_price+$total;
    try {
        $sql = $pdo3->prepare('update t_purchase set total_price=? where customer_code=? and purchase_date=?');
        $sql->bindValue(1, $sum);
        $sql->bindValue(2, $customer_code);
        $sql->bindValue(3, $today);
        $sql->execute();
        $pdo3 = null;
    }catch (PDOException $PDOException){
        echo "エラー：" . $PDOException->getMessage();
    }
}


$pdo4=getDB();
foreach ($_SESSION['product'] as $item_code=>$product){
    $pdo = getDB();
    $sql = 'SELECT D.item_code as item_code FROM t_purchase_detail D INNER JOIN t_purchase P ON P.purchase_id=D.purchase_id WHERE P.purchase_date=? AND P.customer_code=? AND D.item_code=?';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(1, $today);
    $stmt->bindValue(2, $customer_code);
    $stmt->bindValue(3,$item_code);
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::PARAM_INT)) {
        $decode=$row['item_code'];
        echo $decode;
    }
    $pdo = null;
    try {
        if (isset($product['size'])) {
            $sql = 'select item_code from m_items where item_name=? and item_size=?';
            $stmt3 = $pdo4->prepare($sql);
            $stmt3->bindValue(1, $product['name']);
            $stmt3->bindValue(2, $product['size']);
        } else {
            $sql = 'select item_code from m_items where item_name=?';
            $stmt3 = $pdo4->prepare($sql);
            $stmt3->bindValue(1, $product['name']);
        }
        $stmt3->execute();
        while ($row = $stmt3->fetch(PDO::PARAM_INT)) {
            $code = $row['item_code'];
        }
    }catch (PDOException $PDOException){
        echo "エラー：" . $PDOException->getMessage();
    }

    try {
        if(isset($date)&&isset($decode)) {
            $pdo6 = getDB();
            $sql = "SELECT D.purchase_id as purchase_id, D.num as num FROM t_purchase_detail D INNER JOIN t_purchase P ON P.purchase_id=D.purchase_id WHERE P.purchase_date=:pudate AND P.customer_code=:cucode AND D.item_code=:itcode";
            $stmt5 = $pdo6->prepare($sql);
            $stmt5->bindValue(':cucode', $customer_code);
            $stmt5->bindValue(':itcode', $code);
            $stmt5->bindValue(':pudate', $today);
            $stmt5->execute();
            $action = $stmt5->fetch(PDO::FETCH_ASSOC);
            $detail = $action['purchase_id'];
            $num = $action['num'];
            $pdo6 = null;
        }
    }catch (PDOException $PDOException){
        echo "エラー：" . $PDOException->getMessage();
    }
    $pdo7 = getDB();
    try {
        if (!isset($detail)) {
            $sql = $pdo7->prepare('insert into t_purchase_detail(purchase_id,item_code,price,num) values(?,?,?,?)');
            $sql->bindValue(1, $id);
            $sql->bindValue(2, $code);
            $sql->bindValue(3, $product['price']);
            $sql->bindValue(4, $product['count']);
        } else {
            $num += $product['count'];
            $sql = $pdo7->prepare('update t_purchase_detail set num=? where purchase_id=? and item_code=?');
            $sql->bindValue(1, $num);
            $sql->bindValue(2, $detail);
            $sql->bindValue(3,$item_code);
        }
        $sql->execute();
    }catch (PDOException $PDOException){
        echo "エラー：" . $PDOException->getMessage();
    }
}
unset($_SESSION['product']);
?>
<div class="thanks">
    <h2 id="center">ありがとうございました</h2>
    <a href="http://aso2001195.perma.jp/test2/TopPage.php">
        <img src="http://aso2001195.perma.jp/test2/img/トップページに戻るボタン.png">
    </a>
</div>
<?php require 'footer.php';?>
