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
try{
    echo "<table>";
    echo "<th>Nummer</th>";
    echo "<th>Model</th>";
    echo "<th>Type</th>";
    echo "<th>Kleur</th>";
    echo "<th>Gewicht</th>";
    echo "<th>Prijs</th>";
    echo "<th>Voorraad</th>";
    $db = new PDO("mysql:host=localhost;dbname=autovoorraad"
        ,"root");
    $query = $db->prepare("SELECT * FROM autos");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as &$data){
        echo "<tr>";
        echo "<td>" . $data["id"] . "</td>";
        echo "<td>" . $data["model"] . "</td>";
        echo "<td>" . $data["type"] . "</td>";
        echo "<td>" . $data["kleur"] . "</td>";
        echo "<td>" . $data["gewicht"] . "</td>";
        echo "<td>" . number_format($data["prijs"], 0, ".", ".") . "</td>";
        echo "<td>" . $data["voorraad"] . "</td>";
        echo "<td>" . "<a href='detail.php'>Details</a>" . "</td>";
        echo "<td>" . "<a href='update.php'>Update</a>" . "</td>";
        echo "<td>" . "<a href='delete.php'>Delete</a>" . "</td>";
        echo "</tr>";

    }
    echo "<br>";

    echo "</table>";
} catch(PDOException $e) {
    die("Error!: " . $e->getmessage());
}
?>
<a href="insert.php">Insert</a>
</body>
</html>