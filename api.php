<?php
error_reporting(E_ALL);
header("Access-Control-Allow-Origin: *");
header("content-type:text/plain");
include_once("php/Endecoder.php");
if (isset($_REQUEST['t']) && isset($_REQUEST['m'])) {
	$r = $t = $m = "";
	$ed = new Endecoder("","");
	$t = $r = $_REQUEST['t'];
	$m = $_REQUEST['m'];
	$ed = new Endecoder($t, $m);
	echo $ed;
} else {
	echo "";
};