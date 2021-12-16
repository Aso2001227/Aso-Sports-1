<?php
echo '<h2 id="center">顧客一覧</h2>';
require_once 'DB_Manager.php';
$pdo=getDB();
$sql='select * from m_customers where Manage_flag=0 and del_flag=0';
$stmt=$pdo->prepare($sql);
$stmt->execute();
echo '<table border="1">';
    echo '<tr><th>顧客コード</th><th>顧客名</th><th>郵便番号</th><th>住所</th><th>電話番号</th><th>メールアドレス</th><th>登録日</th ></tr >';
    while($row=$stmt->fetch(PDO::PARAM_INT)) {
    echo '<tr>';
        echo '<td>',$row['customer_code'],'</td>';
        echo '<td>',$row['name'],'</td>';
        echo '<td>',$row['post_number'],'</td>';
        echo '<td>',$row['address'],'</td>';
        echo '<td>',$row['tel'],'</td>';
        echo '<td>',$row['mail'],'</td>';
        echo '<td>',$row['reg_date'],'</td>';
        echo '</tr>';
    }
    echo '</table>';
$pdo=null;
?>