<?php include "connect.php" ?>
<?php
    
    $stmt = $pdo->prepare("SELECT * FROM member WHERE username LIKE ?");
    if (!empty($_GET)) 
    $value = '%' . $_GET["username"] . '%'; 
    $stmt->bindParam(1, $value); 
    $stmt->execute();
?>
<?php while ($row = $stmt->fetch()) : ?>
    <?php
    echo "<div style='padding: 15px; text-align: center'>";
    echo "<br><img src='".$row["username"].".jpg' width='200'> <br>";
    echo "ชื่อ " .$row["name"]."<br>";
    echo "ที่อยู่ ".$row["address"]."<br>";
    echo "email ".$row["email"]."</div>";
    ?>
<?php endwhile; ?>