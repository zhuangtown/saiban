<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);//shutdown error wwarining!!
session_start();
if(!isset($_SESSION["user_id"])){
	header("Location: Login.php");
}
?>
<!--
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Shift-JIS">
<meta http-equiv="Content-Style-Type" content="text/css">
<link href="css/common.css" rel="stylesheet" type="text/css">
<TITLE> [ê</TITLE>
<style type="text/css">
</style>
</head>
<body id="doc">-->

<?php include('menubar.php'); ?>
	<div id="head">
		<div id="title">
			<h1></h1>

            <TABLE WIDTH="100%" BORDER=0>
                <TR ALIGN="CENTER" WIDTH="">

                    <TD WIDTH="5%"><IMG SRC='img/logo.png' BORDER='0'>

                    <TD WIDTH="65%"></TD>
					
				</TR>
			</TABLE>
		</div>
	</div>

	<div class="list">
		<h3 align="center">

			<span style="color: darkslategray"> [ê</span>
		</h3>
		<table class="l-tbl">
			<col width="20%">
			<col width="60%">
			<TR>
			</TR>

			<TR>
			</TR>

			<TR>
			</TR>
		</table>
		<BR>
	</div>
	<?php

	include_once './Includes/DBconnect.php';
	include_once './filequery.php';
	
	//DBÖÚ±
	$db=DBconnect();
	mysql_set_charset('sjis');
	
	$sql_year="SELECT DISTINCT DATE_FORMAT(updatetime,\"%Y\") FROM work";
	$res_year=mysql_query($sql_year,$db) or die("DB putout error");
	
	//2014-10-30
	$sql_kind = "SELECT name FROM doctype";
    $res_kind = mysql_query($sql_kind, $db) or die("DB putout error");
	$sql_customer = "SELECT name FROM customer";
    $res_customer = mysql_query($sql_customer, $db) or die("DB putout error");
	//2014-10-30
	
	$result_doctype=mysql_query("select code,name from doctype"); //
	$result_dpt=mysql_query("select code,department from department"); //
	$result_cust=mysql_query("select code,name from customer"); //

	$arr_doctype;
	while ($row_doctype=mysql_fetch_array($result_doctype)) {
		$arr_doctype[$row_doctype["code"]]=$row_doctype["name"];
	}

	$arr_dpt;
	while ($row_dpt=mysql_fetch_array($result_dpt)) {
		//$arr_dpt=array("code"=>$row_dpt["code"],"name"=>$row_dpt["department"]);
		$arr_dpt[$row_dpt["code"]]=$row_dpt["department"];
	}

	$arr_cust;
	while ($row_cust=mysql_fetch_array($result_cust)) {
		$arr_cust[$row_cust["code"]]=$row_cust["name"];
	}

	?>
	<form action=filemanMainten.php method=post>
 <table class="l-tbl">
                <col width="20%">
                <col width="60%">
				 <TR>
                    <TH class="l-cellsec">íÞ</TH>
                    <TD class="l-cellodd"><select name="inpKind">
                    <?php 
                    $Count = 0;
                    while($row=mysql_fetch_array($res_kind))
                    {
                        $WorkName[$Count] = $row[0];
                            
                        ?>
                        
                            <option value="<?php echo $WorkName[$Count]?>"
                            <?php if(isset($_POST['inpKind'])){if($_POST['inpKind']==$WorkName[$Count]){echo("selected");}}?>>
                                <?php echo $WorkName[$Count]?>
                                <?php 
                                $Count++;
                    }
                    ?>
                    
                    </select>
                    </TD>
                </TR>
            <TR>
                    <TH class="l-cellsec">N</TH>
                    <TD class="l-cellodd"><select name="oneYear">
                    <?php 
                    $Count = 0;
                    while($row=mysql_fetch_array($res_year))
                    {
                        $WorkName[$Count] = $row[0];
                        ?>
                            <option value="<?php echo $WorkName[$Count]?>"
                            <?php if(isset($_POST['oneYear'])){if($_POST['oneYear']==$WorkName[$Count]){echo("selected");}}?>>
                                <?php echo $WorkName[$Count]?>
                                <?php 
                                $Count++;
                    }
                    ?>
                    
                    </select>
                    </TD>
                </TR>
                <TR>
                    <TH class="l-cellsec">æøæ</TH>
                    <TD class="l-cellodd"><select name="inpCustomer">
                     <option value="00">---</option>
                    <?php 
                    $Count = 0;
                    while($row=mysql_fetch_array($res_customer))
                    {
                        $WorkName[$Count] = $row[0];
                        ?>
                            <option value="<?php echo $WorkName[$Count]?>"
                            <?php if(isset($_POST['inpCustomer'])){if($_POST['inpCustomer']==$WorkName[$Count]){echo("selected");}}?>>
                                <?php echo $WorkName[$Count]?>
                                <?php 
                                $Count++;
                    }
                    ?>
                    
                    </select>
                    </TD>
                </TR>
                <TR> <th class="l-cellsec"><input type="submit" name="searchOk" value="T[`" class="m-btn" ></th>
				<td class="l-cellsec"><a href="excel/ecceltest.php"><input type="button" name="searchOk"   value="ExcelÞì¬" class="m-btn" ></a></td>
				</TR>
				 
            </table>
      </form>
      
 <?php  if(isset($_POST['searchOk'])){
 	
  fileQuery($_POST['inpKind'],$_POST['inpCustomer'],$_POST['oneYear']);
  $sql_thquery="SELECT * FROM thquery ";
  $res_thquery=mysql_query($sql_thquery,$db);

?>
	<div class="list">
		<p>&nbsp;</p>
		<table><TR><TD><?php if($_POST['inpCustomer']=="00"){echo $_POST['oneYear']."--".$_POST['inpKind']; } else{echo $_POST['oneYear']."--".$_POST['inpCustomer']."Ì".$_POST['inpKind'];}?></TD></TR></table>
		<table class="l-tbl">
		    <colgroup>
		    <col width="2%">
			<col width="20%">
			<col width="3%">
			<col width="3%">
			<col width="3%">
			<col width="3%">
			<col width="3%">
			<col width="3%">
			<col width="3%">
			<col width="3%">
			<col width="3%">
			<col width="3%">
			<col width="3%">
			<col width="3%">
			<col width="3%">
			<col width="3%">
			<col width="3%">
			<col width="3%">
			<col width="3%">
			<col width="3%">
			<col width="3%">
			<col width="3%">
			<col width="3%">
			<col width="3%">
			<col width="3%">
			<col width="3%">
			<col width="3%">
			<col width="3%">
		
			</colgroup>
			<TR>
				<TH class="l-cellcenter">No.</TH>
				<TH class="l-cellcenter">ïÐ¼</TH>
				<TH colspan="2" class="l-cellcenter">P</TH>
				<TH colspan="2" class="l-cellcenter">Q</TH>
				<TH colspan="2" class="l-cellcenter">R</TH>
				<TH colspan="2" class="l-cellcenter">S</TH>
				<TH colspan="2" class="l-cellcenter">T</TH>
				<TH colspan="2" class="l-cellcenter">U</TH>
				<TH colspan="2" class="l-cellcenter">V</TH>
				<TH colspan="2" class="l-cellcenter">W</TH>
				<TH colspan="2" class="l-cellcenter">X</TH>
				<TH colspan="2" class="l-cellcenter">PO</TH>
				<TH colspan="2" class="l-cellcenter">PP</TH>
				<TH colspan="2" class="l-cellcenter">PQ</TH>
				<TH colspan="2" class="l-cellcenter">v</TH>
			</TR>
				
			<TR>
			<td class="l-cellodd"></td>
			<td class="l-cellodd"></td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">àz</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">Åà</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">àz</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">Åà</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">àz</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">Åà</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">àz</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">Åà</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">àz</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">Åà</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">àz</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">Åà</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">àz</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">Åà</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">àz</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">Åà</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">àz</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">Åà</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">àz</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">Åà</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">àz</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">Åà</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">àz</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">Åà</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">àz</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">Åà</td>
		
		</TR>
		<?php while($row_thquery= mysql_fetch_array($res_thquery)){
		$sumprice=$row_thquery[2]+$row_thquery[3]+$row_thquery[4]+$row_thquery[5]+$row_thquery[6]+$row_thquery[7]+$row_thquery[8]+$row_thquery[9]+$row_thquery[10]+$row_thquery[11]+$row_thquery[12]+$row_thquery[13];
		$shzsumprice=$sumprice*0.08;
		
		
		?>
		
		<TR>
		
		<TD  class="l-cellodd"><input type="text"
					value="<?php echo $row_thquery[0] ?>" readonly=true
					style="text-align:center;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
			<TD class="l-cellodd"><input type="text"
					value="<?php echo $row_thquery[1] ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[2]) ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[2]*0.08) ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[3]) ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[3]*0.08) ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[4]) ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[4]*0.08) ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[5]) ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[5]*0.08) ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[6]) ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[6]*0.08)?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[7]) ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[7]*0.08) ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[8])?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[8]*0.08) ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[9]) ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[9]*0.08) ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[10]) ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[10]*0.08) ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[11]) ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[11]*0.08) ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[12]) ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[12]*0.08) ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[13]) ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[13] *0.08)?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($sumprice) ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($shzsumprice)?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		</TR>	<?php
		 }?>
		 <?php 
		$sql_sum="SELECT sum(moo1),sum(moo2),sum(moo3),sum(moo4),sum(moo5),sum(moo6),sum(moo7),sum(moo8),sum(moo9),sum(moo10),sum(moo11),sum(moo12) FROM thquery";
		$res_sum=mysql_query($sql_sum,$db) or die("DB output error");
		while($row_sum=mysql_fetch_array($res_sum)){
		$summoon=$row_sum[0]+$row_sum[1]+$row_sum[2]+$row_sum[3]+$row_sum[4]+$row_sum[5]+$row_sum[6]+$row_sum[7]+$row_sum[8]+$row_sum[9]+$row_sum[10]+$row_sum[11];
		
			
		?>
		<TR>
		<TD  class="l-cellodd"><input type="text"
					value="<?php echo "v"?>" readonly=true
					style="text-align:center;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo ""?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_sum[0])?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_sum[0]*0.08)?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_sum[1])?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_sum[1]*0.08)?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_sum[2])?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_sum[2]*0.08)?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_sum[3])?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_sum[3]*0.08)?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_sum[4])?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_sum[4]*0.08)?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_sum[5])?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_sum[5]*0.08)?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_sum[6])?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_sum[6]*0.08)?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_sum[7])?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_sum[7]*0.08)?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_sum[8])?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_sum[8]*0.08)?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_sum[9])?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_sum[9]*0.08)?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_sum[10])?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_sum[10]*0.08)?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_sum[11])?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_sum[11]*0.08)?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($summoon)?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($summoon*0.08)?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		
		
        </TR>
       <?php }}
			
		?>
		</table>
		
		<TR>
		
	
		
</div>
		


</body>
</html>
