<?php
//DB
	//if (!($db=mysql_connect("192.168.1.101","root",""))) {
	if (!($db=mysql_connect("localhost","root",""))) {
		exit('DB connect NG');
	}
	else{
		//echo('<span style="color:#E0E9E0">DB connect OK!</span>');
	}
	//DB
	$con = mysql_select_db("syman",$db);
	if(!$con){
		die("DB connect NG");
	}
	
  	$sql_delete= "delete FROM fileman where seqno='".$_POST['seqNo']."'";
	$del_do = mysql_query($sql_delete, $db) or die("DB putout error");
	header('Location: filemanMainten.php' );
?>