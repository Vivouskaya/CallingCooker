<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=callingcooker', 'root', 'gfp');
}
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>

<?php

$request = $bdd->prepare("INSERT INTO client (email, username, password) VALUES (?, ?, ?)");
$first = $_POST["email"];
$second = $_POST["username"];
$th = $_POST["password"];
$request->bindParam(1, $first);
$request->bindParam(2, $second);
$request->bindParam(3, $th);
$request->execute();
header('Location: index.php');

?>