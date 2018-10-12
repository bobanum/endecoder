<?php
error_reporting(E_ALL);
include_once("endecoder.class.php");
$r = $t = $m = "";
$chaine = new Endecoder("","");
if (isset($_REQUEST['t']) && isset($_REQUEST['m'])) {
	$t = $r = $_REQUEST['t'];
	$m = $_REQUEST['m'];
	$chaine = new Endecoder($t, $m);
	if (!isset($_REQUEST['f'])) {
		header("content-type:text/plain");
		echo $chaine;
		exit;
	}
};
?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<title>Endecoder</title>
	<meta charset="UTF-8" />
	<link rel="stylesheet" href="endecoder.css" />
	<script src="Endecoder.js"></script>
</head>

<body>
	<div class="interface">
		<header>
			<img src="favicon.svg" width="64" alt=""><h1>Endecoder</h1>
		</header>
		<footer>&copy; 2018</footer>
		<div class="body">
			<div class="instructions">
				<p>Permet d'encoder et de décoder une chaîne de caractères.</p>
				<table class="modes" border="1">
					<caption>Modes</caption>
					<thead>
						<tr>
							<th>E</th>
							<th>D</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr><td>B</td><td>b</td><th>base64</th></tr>
						<tr><td>G</td><td>g</td><th>compression gzlib</th></tr>
						<tr><td>U</td><td>u</td><th>url</th></tr>
						<tr><td>W</td><td>w</td><th>uu</th></tr>
						<tr><td>X</td><td>x</td><th>hexadecimal</th></tr>
						<tr><td>C</td><td>c</td><th>majuscules</th></tr>
						<tr><td>F</td><td>f</td><th>utf-8</th></tr>
						<tr><td>5</td><td></td><th>md5</th></tr>
					</tbody>
				</table>
				<h2>API</h2>
				<p>Accepte la méthode get ou post.</p>
				<p>Les données attendues sont : "m" pour les modes, "t" pour le texte à transformer et "f" pour l'affichage du résultat dans le formulaire.</p>
				<p>Si la donnée "f" n'est pas présente, ne fait qu'afficher le résultat.</p>
				<p>Si la donnée "t" ou "m" n'est pas présente, cette page est affichée.</p>
			</div>
			<div class="field" id="field-t">
				<label for="t">Texte à convertir</label>
				<textarea form="form1" name="t" cols="30" rows="5" id="t" placeholder="Texte à convertir"><?php echo ($chaine->original) ?></textarea>
			</div>
			<!--
			<div class="field">
				<label for="t">Fichier à convertir</label>
				<textarea form="form1" name="t" cols="30" rows="5" id="t" placeholder="Fichier à convertir"><?php echo ($chaine->original) ?></textarea>
			</div>
			-->
			<!--
			<div class="field">
				<label for="t">Adresse à convertir</label>
				<textarea form="form1" name="t" cols="30" rows="5" id="t" placeholder="Adresse à convertir"><?php echo ($chaine->original) ?></textarea>
			</div>
			-->
			<div class="field" id="field-m">
				<label for="m">Modes</label>
				<input form="form1" placeholder="Séquence de modes" type="text" name="m" id="m" value="<?php echo $chaine->modes ?>" />
				<b class="reverse" title="Inverser les données" onclick="Endecoder.reverse.apply(this, arguments);"></b>
			</div>
			<div class="field" id="field-r">
				<label for="t">Résultat de la conversion</label>
				<textarea form="form1" id="r" cols="30" rows="5" readonly="readonly" placeholder="Résultat de la conversion"><?php echo $chaine ?></textarea>
			</div>
			<form action="" method="post" enctype="multipart/form-data" id="form1">
				<div>
					<input type="submit" />
					<label><input type="checkbox" name="f" value="" checked="checked" /> Réafficher le formulaire</label>
				</div>
			</form>
		</div>
	</div>
</body>

</html>
