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
<TITLE>帳票一覧</TITLE>
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

                    <TD WIDTH="5%"><!--<IMG SRC='img/logo.png' BORDER='0'>-->

                    <TD WIDTH="65%"></TD>
					
				</TR>
			</TABLE>
		</div>
	</div>

	<div class="list">
		<h3 align="center">

			<span style="color: darkslategray">請求書一覧</span>
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
	
	//DBへ接続
	$db=DBconnect();
	mysql_set_charset('sjis');
	
	$sql_year="SELECT DISTINCT DATE_FORMAT(updatetime,\"%Y\") FROM accountwork";
	$res_year=mysql_query($sql_year,$db) or die("DB putout error");
	
		//2014-10-30
	$sql_customer = "SELECT name FROM customer";
    $res_customer = mysql_query($sql_customer, $db) or die("DB putout error");
	//2014-10-30
	
	$result_dpt=mysql_query("select code,department from department"); //
	$result_cust=mysql_query("select code,name from customer"); //


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
	<form action=accountcost.php method=post>
 <table class="l-tbl">
                <col width="20%">
                <col width="60%">
				 <TR>
                    <TH class="l-cellsec">種類</TH>
                    <TD class="l-cellodd" style="font-size:18px;">請求書
                    </TD>
                </TR>
            <TR>
                    <TH class="l-cellsec">年度</TH>
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
                    <TH class="l-cellsec">月分</TH>
                    <TD class="l-cellodd">
					<input type="checkbox" name="moon1" value="moon">1月
					<input type="checkbox" name="moon2" value="moon">2月
					<input type="checkbox" name="moon3" value="moon">3月
					<input type="checkbox" name="moon4" value="moon">4月
					<input type="checkbox" name="moon5" value="moon">5月
					<input type="checkbox" name="moon6" value="moon">6月<br>
					<input type="checkbox" name="moon7" value="moon">7月
					<input type="checkbox" name="moon8" value="moon">8月
					<input type="checkbox" name="moon9" value="moon">9月
					<input type="checkbox" name="moon10" value="moon">10月
					<input type="checkbox" name="moon11" value="moon">11月
					<input type="checkbox" name="moon12" value="moon">12月
					</TD>
                </TR>
				<TR>
                    <TH class="l-cellsec"></TH>
                    <TD class="l-cellodd">
					<input type="checkbox" name="moneyNotax" value="money">金額（税抜き）
					<input type="checkbox" name="moon1Tax" value="money">金額（税込）
					<input type="checkbox" name="tax" value="money">税金
					
                    </TD>
                </TR>
                <TR>
                    <TH class="l-cellsec">取引先</TH>
                    <TD class="l-cellodd"><select name="inpCustomer"   id="inpCustomer" >
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
							</option>
                                <?php 
                                $Count++;
                    }
                    ?>
                    
                    </select>
                    </TD>
                </TR>
                <TR> <th class="l-cellsec"><input type="submit" name="searchOk" value="検索" class="m-btn" ></th>
				<th class="l-cellsec"><input type="button" name="excelOk" value="Excel作成" onclick="window.location.reload('excel/doexcel.php')" class="m-btn" ></th>
				</TR>	 
            </table>
      </form>
      
 <?php 
  if(isset($_POST['searchOk'])){
  $type="請求書";	
  fileQuery($type,$_POST['inpCustomer'],$_POST['oneYear']);
  $sql_thquery="select name,sum(moo1),sum(moo2),sum(moo3),sum(moo4),sum(moo5),sum(moo6),sum(moo7),sum(moo8),sum(moo9),sum(moo10),sum(moo11),sum(moo12) from thquery  group by name";
  $res_thquery=mysql_query($sql_thquery,$db) or die ("db !!!");
  //$sql_thquery="SELECT * FROM thquery ";
 // $res_thquery=mysql_query($sql_thquery,$db);

?>
	<div class="list">
		<p>&nbsp;</p>
		<table><TR><TD><?php if($_POST['inpCustomer']=="00"){echo $_POST['oneYear']."--"."請求書"; } else{echo $_POST['oneYear']."--".$_POST['inpCustomer']."の"."請求書";}?></TD></TR></table>
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
				<TH class="l-cellcenter">会社名</TH>
				<TH colspan="2" class="l-cellcenter">１月</TH>
				<TH colspan="2" class="l-cellcenter">２月</TH>
				<TH colspan="2" class="l-cellcenter">３月</TH>
				<TH colspan="2" class="l-cellcenter">４月</TH>
				<TH colspan="2" class="l-cellcenter">５月</TH>
				<TH colspan="2" class="l-cellcenter">６月</TH>
				<TH colspan="2" class="l-cellcenter">７月</TH>
				<TH colspan="2" class="l-cellcenter">８月</TH>
				<TH colspan="2" class="l-cellcenter">９月</TH>
				<TH colspan="2" class="l-cellcenter">１０月</TH>
				<TH colspan="2" class="l-cellcenter">１１月</TH>
				<TH colspan="2" class="l-cellcenter">１２月</TH>
				<TH colspan="2" class="l-cellcenter">合計</TH>
			</TR>
				
			<TR>
			<td class="l-cellodd"></td>
			<td class="l-cellodd"></td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">金額</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">税金</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">金額</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">税金</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">金額</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">税金</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">金額</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">税金</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">金額</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">税金</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">金額</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">税金</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">金額</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">税金</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">金額</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">税金</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">金額</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">税金</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">金額</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">税金</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">金額</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">税金</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">金額</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">税金</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">金額</td>
			<td class="l-cellodd" style="text-align:center;border-width: 1px;font-weight:bold;color:steelblue">税金</td>
		
		</TR>
		<?php while($row_thquery= mysql_fetch_array($res_thquery)){
		$sumprice=$row_thquery[1]+$row_thquery[2]+$row_thquery[3]+$row_thquery[4]+$row_thquery[5]+$row_thquery[6]+$row_thquery[7]+$row_thquery[8]+$row_thquery[9]+$row_thquery[10]+$row_thquery[11]+$row_thquery[12];
		$shzsumprice=$sumprice*0.08;
		
		
		?>
		
		<TR>
		
		<TD  class="l-cellodd"><input type="text"
					value="<?php echo "1" ?>" readonly=true
					style="text-align:center;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
			<TD class="l-cellodd"><input type="text"
					value="<?php echo $row_thquery[0] ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[1]) ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[1]*0.08) ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[2]) ?>" readonly=true
					style="text-align:right;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo number_format($row_thquery[2] *0.08)?>" readonly=true
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
					value="<?php echo "合計"?>" readonly=true
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
