<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="./script/jquery.js"></script>
    <script type="text/javascript" src="./script/callingcooker.js"></script>
    <link type="text/css" rel="stylesheet" href="./css/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="./css/callingcooker.css">
    <title>CallingCooker</title>
    <meta charset="utf-8">
</head>
<body>
<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=callingcooker', 'root', 'gfp');
}
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
?>

<?php
// On démarre la session (ceci est indispensable dans toutes les pages de notre section membre)
session_start ();
?>
<nav class="navbar">
    <div class="col-md-12">
        <div class="col-md-2">
            <p class="calling">CallingCooker</p>
        </div>
        <div class="col-md-8"></div>
        <div class="col-md-2">
            <p class="logs"> Bienvenue <b><?php echo $_SESSION['username'] ?></b> <a href="logout.php">Se déconnecter</a> </p>
        </div>
    </div>
</nav>

<span class="titreresto"><?php echo $_GET['cooker'] ?></span>

<div class="row">
    <?php
    $dat = $bdd->query('select cooker.cooker_id from cooker where cooker.username = \'' . $_GET["cooker"] . '\' ');

    foreach ($dat as $daa) {  $daa['cooker_id'];}
    $answer = $bdd->query('SELECT * FROM menu WHERE menu.cooker_id = \'' . $daa['cooker_id'] . '\' ');
    foreach ($answer as $data ) {
        ?>

        <div class="vignette">
            <div class="col-md-3">
                <div class="panel panel-warning">
                    <div class="panel-heading">
                        <p><b><?php echo $data['name']; ?></b></p>
                    </div>
                    <div class="panel-body">
                        <!--<p><b>menuID: </b><?php /*echo $data['id']; */?></p>
                <p><b>menuCookerID: </b><?php /*echo $data['cooker_id']; */?></p>-->
                        <p><b>Description: </b><?php echo $data['descr']; ?></p>
                        <p><b>Prix: </b><?php echo $data['price']; ?>€</p>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }

    ?>

</div>


</body>
</html>