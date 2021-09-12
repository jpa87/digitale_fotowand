<?php
	# Skriptablauf:
	# Indexiere alle Fotos im Verzeichnis /src/
	# Zerlege die Bilder anhand der Unterstriche _
	# [0] ist Kürzel
	# [1] ist Name
	# [2] ist Fächer
	# [3] ist Sonderfunktion
	# Reihe die Informationen per HTML aneinander
	# evtl. kann man noch die Schulleitungsebene nach vorne sortieren
	include_once('password.php');
	if (isset($_POST['password']) && $_POST['password'] == $password) {
		$_SESSION['authenticated'] = true;
	} elseif (isset($_POST['password'])) {
		$message = "Passwort falsch.";
	}
	
	if (!isset($_SESSION['authenticated'])) {
		include_once('auth.php');
		die;
	}
	
	include_once('faecherkanon.php');
	
	$dir = "./src";
	$files = scandir($dir);
	
	$num = 0;
	
	$table = "";
	foreach ($files as $file) {
		# Überspringe . und ..
		if ($file == "." || $file == "..") { continue; }
		# if (filesize("./src/".$file) < 50000 && $_GET['preview'] != 1) { continue; }
		
		# Zerlege den Dateinamen in seine Bestandteile
		$nameparts = explode("_",str_replace(['.JPG', '.jpg', '.JPEG', '.jpeg', '.png', '.PNG'],"",$file));
		$kuerzel = $nameparts[0];
		$name = $nameparts[1];
		
		unset($faecher);
		unset($fachkuerzel);
		unset($faecherkuerzel);
		# Fächernamen ersetzen
		$fachkuerzel = $nameparts[2];
		$faecherkuerzel = explode('-',$fachkuerzel);
		asort($faecherkuerzel);
		foreach ($faecherkuerzel as $fach) {
			if (isset($faecher)) { $faecher .= " & "; } else { $faecher = ""; }
			$faecher .= $faecherkanon[$fach];
		}
		
		if (isset($nameparts[3])) { 
			$funktionen = str_replace("-"," & ",$nameparts[3]);
			} else { 
			$funktionen = ""; 
		}
		
		$table .= '<div class="w3-quarter w3-center">
					<img class="w3-border" src="./src/'.$file.'" style="width:100%">
					<div class="w3-container">
					<p>'.$name.'</p>
					<p class="w3-small">('.trim($kuerzel).')</p>
					<p class="w3-small">'.$faecher.'</p>
					<p class="w3-small">'.$funktionen.'</p></div></div>' ;
		
		# alle fünf Bilder soll eine neue Zeile entstehen
		$num++;
		if ($num % 4 == 0 && $num % 12 != 0) { $table .= "</div><div class='w3-container'>"; }
		elseif ($num % 12 == 0) { $table .= "</div><div class='w3-container' style='page-break-before: always;'>"; }
	}
	
	$content = "

		<div class='w3-container'>".$table."</div></html>";
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
<?php echo $content; ?>
</body>
</html>