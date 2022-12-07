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
    if (isset($_GET['id'])) {
        $query = $db->prepare("DELETE FROM autos WHERE id = :id");
        $query->bindParam("id", $_GET['id']);
        if ($query->execute()) {
            echo "<br>";
            echo "Het item is verwijderd.";
            header("Location: index.php");
            echo "<br>";
        } else {
            echo "Er is een fout opgetreden.";
        }
    }
} catch(PDOException $e) {
    die("Error!: " . $e->getmessage());
}
$query = $db->prepare("SELECT * FROM autos");
$query->execute();
echo "<br>";
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as &$data) {
    echo "<a href='delete.php?id=" . $data['id'] . "'>";
    echo $data['model'] . " " . $data['prijs'] . " " . $data['voorraad'];
    echo "<br>";
    echo "</a>";
    echo "<br>";
}
?>
</body>
</html>