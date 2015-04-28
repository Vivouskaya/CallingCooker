<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=callingcooker', 'root', 'gfp');
}
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
session_start ();

$client = $bdd->query('SELECT client_id FROM client WHERE username=\'' . $_SESSION['username'] . '\'');
foreach($client as $cli) {
    $cli['client_id'];
}
$goodClick = $bdd->query('SELECT client_id FROM votes_good WHERE cooker_id =\'' . $_GET['cooker_id'] . '\' ');
$oneClick = $bdd->query('SELECT client_id FROM votes_bad WHERE cooker_id =\'' . $_GET['cooker_id'] . '\' ');
foreach($oneClick as $one) {
    echo $one['client_id'];
}
foreach($goodClick as $good) {
    echo $good['client_id'];
}
if($one['client_id'] == $cli['client_id'] || $good['client_id'] == $cli['client_id']) {
    $msgVotes = "Vous avez déjà voté pour ce restaurant";
    header("Location: loginClient.php?msgVotes=$msgVotes");
}
else {
    $result = $bdd->query('INSERT INTO votes_bad(cooker_id, client_id) VALUES (\'' . $_GET['cooker_id'] . '\', \'' . $cli['client_id'] . '\')');
    header ('location: loginClient.php');
}

