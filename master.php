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
    if(isset($_POST['verzenden'])){
        $model = $_POST['model'];
        $prijs = $_POST['prijs'];
        $voorraad = $_POST['voorraad'];
        $query = $db->prepare("UPDATE autos SET prijs = :prijs, 
        voorraad = :voorraad WHERE id = :id");
        $query->bindParam("prijs", $prijs);
        $query->bindParam("voorraad", $voorraad);
        $query->bindParam("id", $_GET['id']);
        if ($query->execute()) {
            echo "<br>";
            echo "De nieuwe gegevens zijn toegevoegd.";
            echo "<br>";
        } else {
            echo "Er is een fout opgetreden.";
        } echo "<br>";

    } else{
        $query = $db->prepare("SELECT * FROM autos WHERE id = :id");
        $query->bindParam("id", $_GET['id']);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($result as &$data) {
            $model = $data["model"];
            $prijs =  $data["prijs"];
            $voorraad =  $data["voorraad"];
        }
    }
} catch(PDOException $e) {
    die("Error!: " . $e->getmessage());
}
?>
<form method="post" action="">
    <label>Model</label>
    <input type="text" name="model" value="<?php echo $model; ?>"><br>
    <label>Prijs</label>
    <input type="text" name="prijs" value="<?php echo $prijs; ?>"><br>
    <label>Voorraad</label>
    <input type="text" name="voorraad" value="<?php echo $voorraad; ?>"><br>
    <br>
    <input type="submit" name="verzenden" value="Verzenden">
</form>
</body>
</html>

