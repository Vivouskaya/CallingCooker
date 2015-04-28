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



<?php
$request = $bdd->query('SELECT * FROM cooker');

foreach($request as $r) {

    ?>
    <?php if(isset($_GET['msgVotes'])) echo '<div class="alert alert-danger" role="alert">' .$_GET['msgVotes']. '</div>';?>
    <div class="list">
        <div class="col-md-3">
            <div class="panel panel-success">
                <div class="panel-heading">
                    <?php
                    $time_actual = time();
                    $time_open = $r['timeopen'];
                    $timeO = strtotime($time_open);
                    $time_close = $r['timeclose'];
                    $timeC = strtotime($time_close);

                    if ($timeC < $timeO) {
                        $fff = strtotime('+1 day', $timeC);
                        $timeC = $fff;
                    }
                    ?>
                    <?php if ($r['active_session'] == 1) {
                        echo '<img id="online" src="img/online.png"/>';
                    }
                    else {
                        echo '<img id="offline" src="img/offline.png"/>';
                    }
                    ?>
                    <a href="detailCooker.php?cooker=<?php echo $r['username']; ?>">
                        <b><?php echo $r['username']; ?></b>
                    </a>

                </div>
                <div class="panel-body">
                    <p><b>CookerID: </b><?php echo $r['cooker_id']; ?></p>
                    <p><b>Contact: </b><a href=""><?php echo $r['email']; ?></a></p>
                    <p>
                        <b>Horraires: </b><?php echo $r['timeopen']; ?> - <?php echo $r['timeclose']; ?>
                        <?php
                        if($timeO < $time_actual && $timeC > $time_actual) {
                            echo '<img id="open" src="img/open.png"/>';
                        }
                        else {
                            echo '<img id="close" src="img/close.png"/>';
                        }
                        ?>
                        <p>
                        <a href="requestLike.php?cooker_id=<?php echo $r['cooker_id']; ?>"><img id="like" src="img/like.png" /></a>
                        <?php
                        $good=$bdd->query('SELECT COUNT(*) AS id FROM votes_good WHERE cooker_id=\'' . $r['cooker_id'] . '\'');
                        foreach($good as $g) {
                            echo $g['id'];
                        }
                        ?>
                        <a href="requestUnLike.php?cooker_id=<?php echo $r['cooker_id']; ?>"><img id="unlike" src="img/unlike.png" /></a>
                        <?php
                            $bad=$bdd->query('SELECT COUNT(*) AS id FROM votes_bad WHERE cooker_id=\'' . $r['cooker_id'] . '\'');
                            foreach($bad as $b) {
                                echo $b['id'];
                            }
                        ?>
                        </p>
                    </p>
                </div>
            </div>
        </div>
    </div>

<?php
}
?>
</body>
</html>