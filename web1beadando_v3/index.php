<?php
session_start();
	include('./includes/config.inc.php');
	include('./includes/dbConn.tpl.php');


	if (isset($_GET['oldal'])) {
		$oldal = $_GET['oldal'];
		if (isset($oldalak[$oldal]) && file_exists("./templates/pages/{$oldalak[$oldal]['fajl']}.tpl.php")) {
			$keres = $oldalak[$oldal];
		}
		else if (isset($extrak[$oldal]) && file_exists("./templates/pages/{$extrak[$oldal]['fajl']}.tpl.php")) {
			$keres = $extrak[$oldal];
		}
		else { 
			$keres = $hiba_oldal;
			header("HTTP/1.0 404 Not Found");
		}
	}
	else $keres = $oldalak['/'];
	include('./templates/index.tpl.php'); 
	


?>

