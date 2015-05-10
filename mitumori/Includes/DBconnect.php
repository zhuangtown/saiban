<?php

error_reporting(E_ALL ^ E_DEPRECATED);
function DBconnect(){
	//if (!($db=mysql_connect("192.168.1.101","root",""))) {
	if (!($db=mysql_connect("localhost","root",""))) {
		exit('DB connect NG');
	}
	else{
//		echo('<span style="color:#E0E9E0">DB connect OK!</span>');
//		echo('<span style="color:#2F4F4F;font-weight:bolder">DB connect OK!</span>');
	}
	//DB‚Ì‘I‘ð
	$con = mysql_select_db("syman",$db);
	if(!$con){
		die("DB connect NG");
	}
	return $db;
	
}
?>