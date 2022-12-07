<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="css/index.css">
    <?php
    include("includes/header.php");
    ?>
</head>
<body>
<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=autovoorraad"
        , "root");
    $query = $db->prepare("SELECT * FROM autos");
    if ($query->execute())
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $data) {
        echo "<br>";
        echo "<a href='master.php?id=" . $data['id'] . "'>";
        echo $data["model"] . " " . $data["prijs"] . " " . $data["voorraad"];
        echo "</a>";
        echo "<br>";
    }
} catch(PDOException $e) {
    die("Error!: " . $e->getmessage());
}
?>
</body>
</html>