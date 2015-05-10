<?php 
function istable(){

	/*$numargs = func_num_args();  
　　 　echo "変数は: $numargs\n";*/  
　　 　@$args = func_get_args();
　  　var_export($args);  
	$table="";
  if (isset($moneyNotax)){
	if (isset($moon1)) $table.="moo1,";
	if (isset($moon2)) $table.="moo2,";
	if (isset($moon3)) $table.="moo3,";
	if (isset($moon4)) $table.="moo4,";
	if (isset($moon5)) $table.="moo5,";
	if (isset($moon6)) $table.="moo6,";
	if (isset($moon7)) $table.="moo7,";
	if (isset($moon8)) $table.="moo8,";
	if (isset($moon9)) $table.="moo9,";
	if (isset($moon10)) $table.="moo10,";
	if (isset($moon11)) $table.="moo11,";
	if (isset($moon12)) $table.="moo12";
	return $table;
	}
 /* else if($moneyNotax&$moon1Tax&$tax!=1){
    if($moon1) $table.=$moo1.",";$table.=$shz1.",";
	if($moon2) $table.=$moo2.",";$table.=$shz2.",";
	if($moon3) $table.=$moo3.",";$table.=$shz3.",";
	if($moon4) $table.=$moo4.",";$table.=$shz4.",";
	if($moon5) $table.=$moo5.",";$table.=$shz5.",";
	if($moon6) $table.=$moo6.",";$table.=$shz6.",";
	if($moon7) $table.=$moo7.",";$table.=$shz7.",";
	if($moon8) $table.=$moo8.",";$table.=$shz8.",";
	if($moon9) $table.=$moo9.",";$table.=$shz9.",";
	if($moon10) $table.=$moo10.",";$table.=$shz10.",";
	if($moon11) $table.=$moo11.",";$table.=$shz11.",";
	if($moon12) $table.=$moo12.",";$table.=$shz12;
	return $table;
	}
    else if($moneyNotax&$moon1Tax&$tax){
    if($moon1) $table.=$moo1.",";$table.=$shz1.",";$table.=$sum1.",";
	if($moon2) $table.=$moo2.",";$table.=$shz2.",";$table.=$sum2.",";
	if($moon3) $table.=$moo3.",";$table.=$shz3.",";$table.=$sum3.",";
	if($moon4) $table.=$moo4.",";$table.=$shz4.",";$table.=$sum4.",";
	if($moon5) $table.=$moo5.",";$table.=$shz5.",";$table.=$sum5.",";
	if($moon6) $table.=$moo6.",";$table.=$shz6.",";$table.=$sum6.",";
	if($moon7) $table.=$moo7.",";$table.=$shz7.",";$table.=$sum7.",";
	if($moon8) $table.=$moo8.",";$table.=$shz8.",";$table.=$sum8.",";
	if($moon9) $table.=$moo9.",";$table.=$shz9.",";$table.=$sum9.",";
	if($moon10) $table.=$moo10.",";$table.=$shz10.",";$table.=$sum10.",";
	if($moon11) $table.=$moo11.",";$table.=$shz11.",";$table.=$sum11.",";
	if($moon12) $table.=$moo12.",";$table.=$shz12.",";$table.=$sum12;
	return $table;
	}
	else{
	if($moon1) $table.=$moo1.",";$table.=$shz1.",";$table.=$sum1.",";
	if($moon2) $table.=$moo2.",";$table.=$shz2.",";$table.=$sum2.",";
	if($moon3) $table.=$moo3.",";$table.=$shz3.",";$table.=$sum3.",";
	if($moon4) $table.=$moo4.",";$table.=$shz4.",";$table.=$sum4.",";
	if($moon5) $table.=$moo5.",";$table.=$shz5.",";$table.=$sum5.",";
	if($moon6) $table.=$moo6.",";$table.=$shz6.",";$table.=$sum6.",";
	if($moon7) $table.=$moo7.",";$table.=$shz7.",";$table.=$sum7.",";
	if($moon8) $table.=$moo8.",";$table.=$shz8.",";$table.=$sum8.",";
	if($moon9) $table.=$moo9.",";$table.=$shz9.",";$table.=$sum9.",";
	if($moon10) $table.=$moo10.",";$table.=$shz10.",";$table.=$sum10.",";
	if($moon11) $table.=$moo11.",";$table.=$shz11.",";$table.=$sum11.",";
	if($moon12) $table.=$moo12.",";$table.=$shz12.",";$table.=$sum12;
	return $table;
	
	}*/
	}
	
?>  