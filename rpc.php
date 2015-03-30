<?php

require_once("db.inc.php");

error_reporting(E_ALL & ~E_NOTICE);
date_default_timezone_set("Europe/Paris");

if ($_POST['op'] == "post") {
	if (!empty($_POST['n']) && !empty($_POST['m'])) {
		mysql_query("INSERT INTO jnm__messages(Auteur,Message,Date,Validation) VALUES('".mysql_real_escape_string(strip_tags($_POST['n']))."', '".mysql_real_escape_string(strip_tags($_POST['m']))."', NOW(), 0);");
		die("OK");
	} else {
		die("INCOMPLETE");
	}
}
else if ($_POST['op'] == "get") {
	if (!empty($_POST['t'])) {
		$lastId = intval($_POST['t']);
	} else {
		$lastId = 0;
	}

	$query = mysql_query("SELECT IDMessage,Auteur,Message,Date FROM jnm__messages WHERE IDMessage > $lastId AND Validation=1 ORDER BY Date DESC LIMIT 12");
	$all = array();
	while ($row = mysql_fetch_array($query)) {
		$all[] = array("a"=>$row['Auteur'], "m"=>$row['Message'], "d"=>date("H:i:s", strtotime($row['Date'])), "t"=>$row['IDMessage']);
	}
	echo json_encode($all);
}
else if ($_POST['op'] == "approve") {
	if ($_POST['passwd'] == "JNMNancy_No_Haxx_Plz_kthx") {
		mysql_query("UPDATE jnm__messages SET Validation=1 WHERE IDMessage='".intval($_POST['p'])."' LIMIT 1") or die(mysql_error());
	}
}
else if ($_POST['op'] == "disapprove") {
	if ($_POST['passwd'] == "JNMNancy_No_Haxx_Plz_kthx") {
		mysql_query("DELETE FROM jnm__messages WHERE IDMessage='".intval($_POST['p'])."' LIMIT 1") or die(mysql_error());
	}
}


?>
