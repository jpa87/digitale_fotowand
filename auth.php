<?php
	# Skriptablauf:
	# wenn $_SESSION['authenticated'] nicht gesetzt ist, wird dieses Skript geladen.
	# Die Maske versendet Zugangsdaten per HTML-Form (POST) an index.php und wird dort geprüft.
	# Bei Fehlschlag wird ein $message übergeben und dieses Skript erneut geladen.
	
	$content = $message;
?>
<!DOCTYPE html>
<html>
<head>
<title>Unser Kollegium</title>
<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tangerine">
<style>
p {
	line-height: normal;
}
</style>
</head><body>
<div class="w3-content" style="max-width:600px;margin-top:80px;margin-bottom:80px">
<?php if (isset($content)) { echo '<div class="w3-container w3-red"><h2>'.$content.'</h2></div>'; } ?>

<div class="w3-container w3-indigo">
  <h2>Login</h2>
</div>

<form class="w3-container" action="index.php" method="POST">

<label>Passwort:</label>
<input class="w3-input" name="password" type="password">

<button class="w3-button w3-indigo" type="submit">OK</button>
</form>

</div>
</body>
</html>