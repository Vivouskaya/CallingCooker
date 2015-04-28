<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=callingcooker', 'root', 'gfp');
}
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>

<?php

$request = $bdd->prepare("INSERT INTO menu (cooker_id, name, descr, price) VALUES (?, ?, ?, ?)");
$first = $_POST["cooker_id"];
$second = $_POST["name"];
$th = $_POST["descr"];
$fr = $_POST["price"];
$request->bindParam(1, $first);
$request->bindParam(2, $second);
$request->bindParam(3, $th);
$request->bindParam(4, $fr);
$request->execute();
header('Location: loginCooker.php');

?>
