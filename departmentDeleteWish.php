<?php
//DB
	//if (!($db=mysql_connect("localhost","root",""))) {
	if (!($db=mysql_connect("localhost","root",""))) {
		exit('DB connect NG');
	}
	else{
		echo('<span style="color:#E0E9E0">DB connect OK!</span>');
	}
	//DB
	$con = mysql_select_db("syman",$db);
	if(!$con){
		die("DB connect NG");
	}
	
  	$sql_delete= "delete FROM department where code='".$_POST['wishID']."'";
	$del_do = mysql_query($sql_delete, $db) or die("DB putout error");
	header('Location: departmentMainten.php' );
?>