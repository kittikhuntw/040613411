<?php include "connect.php" ?>
<html><head><meta charset="utf-8"></head>
<body>
<div style="display:flex">
<?php
    $stmt = $pdo->prepare("SELECT * FROM member");
    $stmt->execute(); 
?>
<?php while ($row = $stmt->fetch()) : ?>
    <div style="padding: 15px; text-align: center">
        <a href="workshop8detail.php?username=<?=$row["username"]?>">
            <img src='memberphoto/<?=$row["username"]?>.jpg' width='100'><br>
        </a>
        ชื่อสมาชิก : <?=$row ["name"]?><br>
        ที่อยู่ : <?=$row ["address"]?><br>
        อีเมลล์ : <?=$row ["email"]?>
    </div>
<?php endwhile; ?>
</div>
</body></html>  