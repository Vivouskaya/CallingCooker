<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=callingcooker', 'root', 'gfp');
}
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>


<?php
// On définit un login et un mot de passe de base pour tester notre exemple. Cependant, vous pouvez très bien interroger votre base de données afin de savoir si le visiteur qui se connecte est bien membre de votre site
$log = $_POST["username"];
$mdp = $_POST["password"];
$check = $bdd->query("SELECT * FROM cooker WHERE username ='$log' AND password='$mdp'");
$data = $check->fetch();
// on teste si nos variables sont définies
if (isset($_POST['username']) && isset($_POST['password'])) {

    // on vérifie les informations du formulaire, à savoir si le pseudo saisi est bien un pseudo autorisé, de même pour le mot de passe
    if ($data['password'] == $mdp && $data['username'] == $log && $data['password'] !== NULL) {
        // dans ce cas, tout est ok, on peut démarrer notre session

        // on la démarre :)
        session_start ();
        // on enregistre les paramètres de notre visiteur comme variables de session ($login et $pwd) (notez bien que l'on utilise pas le $ pour enregistrer ces variables)
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['password'] = $_POST['password'];

        // on redirige notre visiteur vers une page de notre section membre
        header ('location: loginCooker.php');
    }
    else {
        $msgCooker = "identifiant ou mot de passe inconnu";
        header("Location: index.php?msgCooker=$msgCooker");
    }
}
else {
    echo 'Les variables du formulaire ne sont pas déclarées.';
}
?>