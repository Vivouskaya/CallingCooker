<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=callingcooker', 'root', 'gfp');
}
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>

<?php
session_start ();
echo $_SESSION['username'];
$cooker = $_SESSION['username'];
$timeopen = $_POST["timeopen"];
$timeclose = $_POST["timeclose"];
$request = $bdd->query("UPDATE cooker SET timeopen = '$timeopen', timeclose = '$timeclose' WHERE username = '$cooker'");
header("Location: loginCooker.php");
?>