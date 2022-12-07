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
    echo "<th>Prijs wegenbelasting</th>";
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
        if($data["gewicht"] > 500 && $data["gewicht"] < 750){
            $belasting = 18;
        }else if($data["gewicht"] > 750 && $data["gewicht"] < 1000){
            $belasting = 22;
        } else if($data["gewicht"] > 1000 && $data["gewicht"] < 1500){
            $belasting = 40;
        } else if($data["gewicht"] > 1500){
            $belasting = 60;
        }
        echo "<td>" . $belasting . "</td>";
        echo "</tr>";

    }
    echo "<br>";
    echo "</table>";
} catch(PDOException $e) {
    die("Error!: " . $e->getmessage());
}
?>
</body>
</html>