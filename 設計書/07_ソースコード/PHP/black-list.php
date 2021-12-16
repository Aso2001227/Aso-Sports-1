<?php
require_once 'DB_Manager.php';
echo '<h2>ブラックリスト</h2>';
$sql='select * from m_customers where del_flag=1';
$pdo2=getDB();
$stmt2=$pdo2->prepare($sql);
$stmt2->execute();
echo '<table border="1">';
echo '<tr><th>顧客コード</th><th>顧客名</th><th>郵便番号</th><th>住所</th><th>電話番号</th><th>メールアドレス</th><th>登録日</th ></tr >';
while($row=$stmt2->fetch(PDO::PARAM_INT)) {
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
$pdo2=null;
?>
