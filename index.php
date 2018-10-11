<?php
error_reporting(E_ALL);
$r = $t = $m = "";
if (isset($_REQUEST['t']) && isset($_REQUEST['m'])) {
	$t = $r = $_REQUEST['t'];
	$m = $_REQUEST['m'];
	$modes = str_split($m);
	foreach ($modes as $mode) {
		    if ($mode=='B') {$r=base64_encode($r);}
		elseif ($mode=='b') {$r=base64_decode($r);}
		elseif ($mode=='G') {$r=gzdeflate($r, 9);}
		elseif ($mode=='g') {$r=gzinflate($r);}
		elseif ($mode=='U') {$r=urlencode($r);}
		elseif ($mode=='u') {$r=urldecode($r);}
		elseif ($mode=='W') {$r=convert_uuencode($r);}
		elseif ($mode=='w') {$r=convert_uudecode($r);}
		elseif ($mode=='H') {$r=bin2hex($r);}
		elseif ($mode=='h') {$r=pack('H*', $r);}
		elseif ($mode=='M') {$r=strtoupper($r);}
		elseif ($mode=='m') {$r=strtolower($r);}
		elseif ($mode=='5') {$r=md5($r);}
		elseif ($mode=='F') {$r=utf8_encode($r);}
		elseif ($mode=='f') {$r=utf8_decode($r);}
	}
	if (!isset($_REQUEST['f'])) {
		header("content-type:text/plain");
		echo $r;
		exit;
	}
};
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Endecoder</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<script type="text/javascript">
			function inverser() {
				var t = document.getElementById("t").value;
				var r = document.getElementById("r").value;
				document.getElementById("t").value = r;
				document.getElementById("r").value = t;
				var m = document.getElementById("m").value;
				var m2 = "";
				for (var i=m.length-1; i>=0; i--) {
					var n = m.charCodeAt(i)-32;
					m2 += String.fromCharCode((((m.charCodeAt(i)-32) % 64) + 64));
				}
				document.getElementById("m").value = m2;
			}
		</script>
	</head>
	<body>
	<div style="width:740px; margin:0 auto;">
	<h1>Endecoder</h1>
	<p>Permet d'encoder et de décoder une chaîne de caractères. Accepte la méthode get ou post. Si la donnée "f" n'est pas présente, ne fait qu'afficher le résultat. Les données attendues sont : "m" pour les modes, "t" pour le texte à transformer et "f" pour l'affichage du résultat dans le formulaire. Si la donnée "t" ou "m" n'est pas présente, cette page est affichée.</p>
	<form action="" method="post" enctype="multipart/form-data">
		<div><textarea name="t" cols="30" rows="5" id="t" style="width:100%" placeholder="Texte à convertir" ><?php echo ($t) ?></textarea></div>
		<div><b title="Inverser les données" onclick="inverser.apply(this, arguments);">&#8597;</b><input placeholder="Séquence de modes" type="text" name="m" id="m" value="<?php echo $m ?>" /></div>
		<div>Choix : <b><u>b</u></b>ase64, compression <b><u>g</u></b>zlib, <b><u>u</u></b>rl, <b><u>w</u></b>=uu, <b><u>h</u></b>exadecimal, <b><u>m</u></b>ajuscules*, md<b><u>5</u>*</b>, ut<u><b>f</b></u>8;</div>
		<div>Majuscule pou encoder et minuscule pour décoder</div>
		<div><textarea id="r" cols="30" rows="5" readonly="readonly" style="width:100%" placeholder="Résultat de la conversion" ><?php echo ($r) ?></textarea></div>
		<div><input type="submit"/><label><input type="checkbox" name="f" value="" checked="checked" /> Réafficher le formulaire</label></div>
	</form>
	</div>
	</body>
</html>
