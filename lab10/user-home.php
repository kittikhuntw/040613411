<?php include "connect.php" ?>
<?php session_start(); ?>

<html>
<body>
<h1>สวัสดี <?=$_SESSION["fullname"]?></h1>
หากต้องการออกจากระบบโปรดคลิก <a href='logout.php'>ออกจากระบบ</a>

<?php
  if($_SESSION["isAdmin"] == 1){
    echo "<div><a href='product-list.php'>ดูหน้าสินค้าคงเหลือ</a></div>";
    $stmt = $pdo->prepare(
        "SELECT member.username , count(orders.ord_id) total_order from member 
        LEFT JOIN orders on member.username = orders.username 
        GROUP BY member.username;"
    );
    $stmt->execute(); 
    while ($row = $stmt->fetch()) {
    echo "
        <div style='margin-top:20px;'>
            <div>username : {$row["username"]} </div>
            <div style='display:flex;'>
                <div>จำนวนออเดอร์ : {$row["total_order"]} </div>
                <a style='margin-left:20px;' href='order-detail.php?username={$row['username']}'>ดูรายละเอียดออเดอร์</a>
            </div>
        </div>
    ";
    }
    die();
}
?>


<?php
$stmt = $pdo->prepare("SELECT orders.ord_id,member.username,product.pname,item.quantity,product.price FROM `orders` JOIN member on orders.username = member.username JOIN item on item.ord_id = orders.ord_id JOIN product on item.pid = product.pid WHERE member.username = ?;");
$stmt->bindParam(1, $_SESSION["username"]); 
$stmt->execute();
while ($row = $stmt->fetch()) {
    echo "<div>";
    echo "ออเดอร์ครั้งที่ ".$row["ord_id"];
    echo " ชื่อสินค้า ".$row["pname"];
    echo " จำนวนสินค้า ".$row["quantity"];
    echo " ราคาสินค้า ".$row["price"];
    echo "</div>";
        
}
?>
</body>
</html>
