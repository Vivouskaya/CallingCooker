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

		<div class="logins">
    	<div class="col-md-4 col-md-offset-2">
        <div class="cooker">
        	<form action="requestLoginCooker.php" method="POST">
          	<p><input type="text" name="username" placeholder="identifiant"></p>
            <p><input type="password" name="password" placeholder="mot de passe"></p>
            <p><input type="submit" value="sign in"></p>
          </form>
        </div>
        <form action="RequestRegisterCooker.php" method="POST">
        	<p><input type="text" name="email" placeholder="email"></p>
          <p><input type="text" name="username" placeholder="identifiant"></p>
          <p><input type="password" name="password" placeholder="mot de passe"></p>
          <p><input type="submit" value="Register"></p>
        </form>
			</div>
    </div>

    <div class="col-md-4">
    	<div class="client">
      	<form action="requestLoginClient.php" method="POST">
        	<p><input type="text" name="username" placeholder="identifiant"></p>
          <p><input type="password" name="password" placeholder="mot de passe"></p>
          <p><input type="submit" value="sign in"></p>
        </form>
      </div>
      <form action="RequestRegisterClient.php" method="POST">
      	<p><input type="text" name="email" placeholder="email"></p>
        <p><input type="text" name="username" placeholder="identifiant"></p>
       	<p><input type="password" name="password" placeholder="mot de passe"></p>
        <p><input type="submit" value="Register"></p>
      </form>
    </div>
	</body>
</html>
