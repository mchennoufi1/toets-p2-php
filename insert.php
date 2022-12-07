<!DOCTYPE HTML>
<html>
<head>
    <link rel="stylesheet" href="css/index.css">
    <?php
    include("includes/header.php");
    ?>
</head>
<body>
<div class="container">
    <br>
    <form class="auto" method="post" action="">
        <h3>Toevoegen</h3>
        <label>Model: </label><br>
        <input type="text" name="model">
        <br>
        <label>Type: </label><br>
        <input type="text" name="type">
        <br>
        <label>Kleur: </label><br>
        <input type="text" name="kleur">
        <br>
        <label>Gewicht: </label><br>
        <input type="text" name="gewicht">
        <br>
        <label>Prijs: </label><br>
        <input type="text" name="prijs">
        <br>
        <label>Voorraad: </label><br>
        <input type="text" name="voorraad">
        <br>
        <input type="submit" name="verzenden" value="Verzenden">
    </form>
</div>
<?php
try{
    $db = new PDO("mysql:host=localhost;dbname=autovoorraad"
        ,"root");
    if(isset($_POST['verzenden'])) {
        function validate_input($input) {
            $input = trim($input);
            $input = stripslashes($input);
            $input = htmlspecialchars($input);
            return $input;
        }
        session_start();
        $model= $_POST['model'];
        $type = $_POST['type'];
        $kleur = $_POST['kleur'];
        $gewicht = $_POST['gewicht'];
        $prijs = $_POST['prijs'];
        $voorraad = $_POST['voorraad'];

        if (empty($_POST["model"])) {
            $modelError = "model is required";
            echo "$modelError";

        } else {
            $model = validate_input($_POST["model"]);
            $_SESSION['model'] = $model;

            if (empty($_POST["type"])) {
                $typeError = "type is required";
                echo "$typeError";
            } else {
                $type = validate_input($_POST["type"]);
                $_SESSION['type'] = $type;

                if (empty($_POST["kleur"])) {
                    $kleurError = "kleur is required";
                    echo "$kleurError";
                } else {
                    $kleur = validate_input($_POST["kleur"]);
                    $_SESSION['kleur'] = $kleur;

                    if (empty($_POST["gewicht"])) {
                        $gewichtError = "gewicht is required";
                        echo "$gewichtError";
                    } else {
                        $gewicht = validate_input($_POST["gewicht"]);

                        $_SESSION['gewicht'] = $gewicht;
                        $gewicht = filter_input(INPUT_POST, 'gewicht', FILTER_VALIDATE_INT);
                        if (empty($_POST["prijs"])) {
                            $prijsError = "prijs is required";
                            echo "$prijsError";
                        } else {
                            $prijs = validate_input($_POST["prijs"]);
                            $_SESSION['prijs'] = $prijs;

                            if (empty($_POST["voorraad"])) {
                                $voorraadError = "voorraad is required";
                                echo "$voorraadError";
                            } else {
                                $voorraad = validate_input($_POST["voorraad"]);
                                $_SESSION['voorraad'] = $voorraad;

                                $query = $db->prepare("INSERT INTO autos (model, type, kleur, gewicht, prijs, voorraad)
                            VALUES('$_POST[model]','$_POST[type]','$_POST[kleur]', '$_POST[gewicht]', '$_POST[prijs]', '$_POST[voorraad]')");
                                if ($query->execute()) {
                                    echo "<br>";
                                    echo "<p class='flash-message'>Rij toegevoegd";
                                    echo "</p>";
                                    echo "<br>";

                                } else {
                                    echo "Er is een fout opgetreden.";
                                }
                            }
                        }
                    }
                }
            }
        }
        header("Location: index.php");
    }
} catch(PDOException $e) {
    die("Error!: " . $e->getmessage());
}
?>

</body>
</html>