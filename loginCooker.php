<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="./script/jquery.js"></script>
    <script type="text/javascript" src="./script/callingcooker.js"></script>
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.addmenu').hide();
            $('button').click(function(){
                $('.addmenu').fadeIn();
            });
        });
    </script>
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
        <div class="col-md-8"><div class="buttonAddMenu"><button id="menu" class="btn btn-default">Ajouter un Menu</button></div></div>
        <div class="col-md-2">
            <p class="logs"> Bienvenue <b><?php echo $_SESSION['username'] ?></b> <a href="logout.php">Se déconnecter</a> </p>
        </div>
    </div>
</nav>

<span class="titreresto"><?php echo $_SESSION['username'] ?></span>

<?php

$dat = $bdd->query('select * from cooker where cooker.username = \'' . $_SESSION['username'] . '\' ');

foreach ($dat as $daa) {
    $daa['cooker_id'];
    $daa['active_session'];
    $daa['timeopen'];
    $daa['timeclose'];
}
if ($daa['active_session'] !== NULL)
{
    $bdd->query('UPDATE cooker SET active_session=1 WHERE username=\'' . $_SESSION['username'] . '\'');
}
if ($daa['timeopen'] == NULL && $daa['timeclose'] == NULL) {
    ?>
    <script type="text/javascript">$('#menu').hide()</script>
    <?php
    echo '<div class="panel panel-danger">
            <div class="panel-heading">
                <p><b>RENSEIGNEZ VOS HORRAIRES DE DEBUT ET FIN DE PRISE DE COMMANDES</b></p>
            </div>
            <div class="panel-body">
              <form action="requestHorraireCooker.php" method="POST">
                 <div class="field">
                    Horraire Début de service: <input size="3%" type="time" name="timeopen" placeholder="10:30"></br>
                    </br>
                    Horraire Fin de service: <input size="3%" type="time" name="timeclose" placeholder="20:30"></br>
                    </br>
                    <input type="submit" value="Update">
                 </div>
              </form>
              </div>
          </div>';
}
else {

}
?>

<div class="addmenu">
    <div class="col-md-6 col-md-offset-3">
        <div class="panel panel-warning">
            <div class="panel-heading">

            </div>
            <div class="panel-body">
                <form action="RequestRegisterMenu.php" method="POST">
                    <input type="hidden" name="cooker_id" value="<?php echo $daa['id'] ?>">
                    <p><input type="text" name="name" placeholder="Nom du menu"></p>
                    <p><input type="text" name="descr" placeholder="Description (facultatif)"></p>
                    <p><input type="integer" name="price" placeholder="Prix"></p>
                    <p><input type="submit" value="Register"></p>
                </form>


                <form enctype="multipart/form-data" action="insert.php" method="post" name="changer">
                    <input name="MAX_FILE_SIZE" value="102400" type="hidden">
                    <input name="image" accept="image/jpeg" type="file">
                    <input value="Submit" type="submit">
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row"></div>

<div class="row">
    <?php

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