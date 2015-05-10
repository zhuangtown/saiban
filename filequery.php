<?php 

include_once './Includes/DBconnect.php';
//DB‚ÖÚ‘±
$db=DBconnect();
mysql_set_charset('sjis');
function fileQuery($type,$customer,$year){
	global $db;
	$sql_filequery="DELETE FROM `thquery`";
	mysql_query($sql_filequery,$db) or die("filequery putout error");
	$moon1=0;
	$moon2=0;
	$moon3=0;
	$moon4=0;
	$moon5=0;
	$moon6=0;
	$moon7=0;
	$moon8=0;
	$moon9=0;
	$moon10=0;
	$moon11=0;
	$moon12=0;
	$shz1=0;
	$sum1=0;
	$shz2=0;
	$sum2=0;
	$shz3=0;
	$sum3=0;
	$shz4=0;
	$sum4=0;
	$shz5=0;
	$sum5=0;
	$shz6=0;
	$sum6=0;
	$shz7=0;
	$sum7=0;
	$shz8=0;
	$sum8=0;
	$shz9=0;
	$sum9=0;
	$shz10=0;
	$sum10=0;
	$shz11=0;
	$sum11=0;
	$shz12=0;
	$sum12=0;
	if($customer=="00"){
		
		$sql_work="SELECT saibanRes,unitPrice,trance,addPrice FROM accountwork WHERE DATE_FORMAT(updatetime,\"%Y\")='".$year."'";
		$res_work=mysql_query($sql_work,$db) or die ("0001DB putout error");
		$id=1;
		
		while ($row_work= mysql_fetch_array($res_work, MYSQL_ASSOC)) {
		
			$rest=substr($row_work["saibanRes"],8,3);
				
			$sql_filema="SELECT `name` FROM `customer` WHERE `code` ='". $rest."'";
			$res_filema=mysql_query($sql_filema, $db) or die ("DB putout error02");
			$row_filema=mysql_result($res_filema,0);
			$saiMoon=substr($row_work["saibanRes"],6,2);
			switch ($saiMoon){
				case "01":
					$moon1=$row_work["unitPrice"]+$row_work['addPrice'];
					$shz1=$moon1*0.08;
					$sum1=$moon1+$shz1+$row_work['trance'];
					break;
				case "02":
					$moon2=$row_work["unitPrice"]+$row_work['addPrice'];
					$shz2=$moon2*0.08;
					$sum2=$moon2+$shz2+$row_work['trance'];
					break;
				case "03":
					$moon3=$row_work["unitPrice"]+$row_work['addPrice'];
					$shz3=$moon3*0.08;
					$sum3=$moon3+$shz3+$row_work['trance'];
					
					break;
				case "04":
					$moon4=$row_work["unitPrice"]+$row_work['addPrice'];
					$shz4=$moon4*0.08;
					$sum4=$moon4+$shz4+$row_work['trance'];
					break;
				case "05":
					$moon5=$row_work["unitPrice"]+$row_work['addPrice'];
					$shz5=$moon5*0.08;
					$sum5=$moon5+$shz5+$row_work['trance'];
					break;
				case "06":
					$moon6=$row_work["unitPrice"]+$row_work['addPrice'];
					$shz6=$moon6*0.08;
					$sum6=$moon6+$shz6+$row_work['trance'];
					break;
				case "07":
					$moon7=$row_work["unitPrice"]+$row_work['addPrice'];
					$shz7=$moon7*0.08;
					$sum7=$moon7+$shz7+$row_work['trance'];
					break;
				case "08":
					$moon8=$row_work["unitPrice"]+$row_work['addPrice'];
					$shz8=$moon8*0.08;
					$sum8=$moon8+$shz8+$row_work['trance'];
					break;
				case "09":
					$moon9=$row_work["unitPrice"]+$row_work['addPrice'];
					$shz9=$moon9*0.08;
					$sum9=$moon9+$shz9+$row_work['trance'];
					break;
				case "10":
					$moon10=$row_work["unitPrice"]+$row_work['addPrice'];
					$shz10=$moon10*0.08;
					$sum10=$moon10+$shz10+$row_work['trance'];
					break;
				case "11":
					$moon11=$row_work["unitPrice"]+$row_work['addPrice'];
					$shz11=$moon11*0.08;
					$sum11=$moon11+$shz11+$row_work['trance'];
					break;
				case "12":
					$moon12=$row_work["unitPrice"]+$row_work['addPrice'];
					$shz12=$moon12*0.08;
					$sum12=$moon12+$shz12+$row_work['trance'];
					break;
				default:null;
		
			}
			$sql_thquery="INSERT INTO `thquery`(`id`, `name`, `moo1`, `shz1`, `sum1`, `moo2`, `shz2`, `sum2`, `moo3`, `shz3`, `sum3`, `moo4`, `shz4`, `sum4`, `moo5`, `shz5`, `sum5`, `moo6`, `shz6`, `sum6`, `moo7`, `shz7`, `sum7`, `moo8`, `shz8`, `sum8`, `moo9`, `shz9`, `sum9`, `moo10`, `shz10`, `sum10`, `moo11`, `shz11`, `sum11`, `moo12`, `shz12`, `sum12`)
 VALUES ('".$id."','".$row_filema."','".$moon1."','".$shz1."','".$sum1."','".$moon2."','".$shz2."','".$sum2."','".$moon3."','".$shz3."','".$sum3."','".$moon4."','".$shz4."','".$sum4."','".$moon5."','".$shz5."','".$sum5."','".$moon6."','".$shz6."','".$sum6."','".$moon7."','".$shz7."','".$sum7."','".$moon8."','".$shz8."','".$sum8."','".$moon9."','".$shz9."','".$sum9."','".$moon10."','".$shz10."','".$sum10."','".$moon11."','".$shz11."','".$sum11."','".$moon12."','".$shz12."','".$sum12."')";
			$res_thquery=mysql_query($sql_thquery,$db)  or die("DB putout error04");
			$id=$id+1;
		}
		}
	elseif($customer<>"00"){
		
		
		$customer= mb_ereg_replace('^(@| )+', '', $customer);
		$customer= mb_ereg_replace('(@| )+$', '', $customer);
        $sql_department="SELECT `code` FROM `customer` WHERE `name` = '".$customer."'";
        $res_department=mysql_query($sql_department,$db) or die ("123DB putout error");
        $row_department = mysql_fetch_array($res_department,0);
		echo $row_department[0];
        
        
	    $sql_work="SELECT saibanRes,unitPrice,trance,addPrice FROM accountwork substring(saibanRes,9,3)='".$row_department[0]."') AND DATE_FORMAT(updatetime,\"%Y\")='".$year."'";
		$res_work=mysql_query($sql_work,$db) or die ("0003DB putout error");
		//$row_work=mysql_fetch_array($res_work,0);
		
	
	
	$id=1;
		
	while ($row_work= mysql_fetch_array($res_work, MYSQL_ASSOC)) {
		
		$rest=substr($row_work["saibanRes"],8,3);
			
		$sql_filema="SELECT `name` FROM `customer` WHERE `code` ='". $rest."'";
		$res_filema=mysql_query($sql_filema, $db) or die ("DB putout error02");
		$row_filema=mysql_result($res_filema,0);
		$saiMoon=substr($row_work["saibanRes"],6,2);
		switch ($saiMoon){
					case "01":
					$moon1=$row_work["unitPrice"]+$row_work['addPrice'];
					$shz1=$moon1*0.08;
					$sum1=$moon1+$shz1+$row_work['trance'];
					break;
				case "02":
					$moon2=$row_work["unitPrice"]+$row_work['addPrice'];
					$shz2=$moon2*0.08;
					$sum2=$moon2+$shz2+$row_work['trance'];
					break;
				case "03":
					$moon3=$row_work["unitPrice"]+$row_work['addPrice'];
					$shz3=$moon3*0.08;
					$sum3=$moon3+$shz3+$row_work['trance'];
					
					break;
				case "04":
					$moon4=$row_work["unitPrice"]+$row_work['addPrice'];
					$shz4=$moon4*0.08;
					$sum4=$moon4+$shz4+$row_work['trance'];
					break;
				case "05":
					$moon5=$row_work["unitPrice"]+$row_work['addPrice'];
					$shz5=$moon5*0.08;
					$sum5=$moon5+$shz5+$row_work['trance'];
					break;
				case "06":
					$moon6=$row_work["unitPrice"]+$row_work['addPrice'];
					$shz6=$moon6*0.08;
					$sum6=$moon6+$shz6+$row_work['trance'];
					break;
				case "07":
					$moon7=$row_work["unitPrice"]+$row_work['addPrice'];
					$shz7=$moon7*0.08;
					$sum7=$moon7+$shz7+$row_work['trance'];
					break;
				case "08":
					$moon8=$row_work["unitPrice"]+$row_work['addPrice'];
					$shz8=$moon8*0.08;
					$sum8=$moon8+$shz8+$row_work['trance'];
					break;
				case "09":
					$moon9=$row_work["unitPrice"]+$row_work['addPrice'];
					$shz9=$moon9*0.08;
					$sum9=$moon9+$shz9+$row_work['trance'];
					break;
				case "10":
					$moon10=$row_work["unitPrice"]+$row_work['addPrice'];
					$shz10=$moon10*0.08;
					$sum10=$moon10+$shz10+$row_work['trance'];
					break;
				case "11":
					$moon11=$row_work["unitPrice"]+$row_work['addPrice'];
					$shz11=$moon11*0.08;
					$sum11=$moon11+$shz11+$row_work['trance'];
					break;
				case "12":
					$moon12=$row_work["unitPrice"]+$row_work['addPrice'];
					$shz12=$moon12*0.08;
					$sum12=$moon12+$shz12+$row_work['trance'];
					break;
			default:null;
		
		}
		


		$sql_thquery="INSERT INTO `thquery`(`id`, `name`, `moo1`, `shz1`, `sum1`, `moo2`, `shz2`, `sum2`, `moo3`, `shz3`, `sum3`, `moo4`, `shz4`, `sum4`, `moo5`, `shz5`, `sum5`, `moo6`, `shz6`, `sum6`, `moo7`, `shz7`, `sum7`, `moo8`, `shz8`, `sum8`, `moo9`, `shz9`, `sum9`, `moo10`, `shz10`, `sum10`, `moo11`, `shz11`, `sum11`, `moo12`, `shz12`, `sum12`)
 VALUES ('".$id."','".$row_filema."','".$moon1."','".$shz1."','".$sum1."','".$moon2."','".$shz2."','".$sum2."','".$moon3."','".$shz3."','".$sum3."','".$moon4."','".$shz4."','".$sum4."','".$moon5."','".$shz5."','".$sum5."','".$moon6."','".$shz6."','".$sum6."','".$moon7."','".$shz7."','".$sum7."','".$moon8."','".$shz8."','".$sum8."','".$moon9."','".$shz9."','".$sum9."','".$moon10."','".$shz10."','".$sum10."','".$moon11."','".$shz11."','".$sum11."','".$moon12."','".$shz12."','".$sum12."')";
		$res_thquery=mysql_query($sql_thquery,$db)  or die("DB putout error03");
		$id=$id+1;
	}
	
		
}}	
?>