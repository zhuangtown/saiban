<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);//shutdown error wwarining!!
session_start();
if(!isset($_SESSION["user_id"])){
	header("Location: Login.php");
}
?>

<?php include('menubar.php'); ?>
	<div id="head">
		<div id="title">
			<h1></h1>

            <TABLE WIDTH="100%" BORDER=0>
                <TR ALIGN="CENTER" WIDTH="">
                    <TD WIDTH="65%"></TD>					
				</TR>
			</TABLE>
		</div>
	</div>

	<div class="list">
		<h3 align="center">
			<span style="color: darkslategray">請求書一覧</span>
		</h3>
		<BR>
	</div>
	<?php

	include_once './Includes/DBconnect.php';
	include_once './filequery.php';
	include_once './istable.php';
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
	<form action=demo.php method=post>
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
					<input type="checkbox" name="moon1" value="1">1月
					<input type="checkbox" name="moon2" value="1">2月
					<input type="checkbox" name="moon3" value="1">3月
					<input type="checkbox" name="moon4" value="1">4月
					<input type="checkbox" name="moon5" value="1">5月
					<input type="checkbox" name="moon6" value="1">6月<br>
					<input type="checkbox" name="moon7" value="1">7月
					<input type="checkbox" name="moon8" value="1">8月
					<input type="checkbox" name="moon9" value="1">9月
					<input type="checkbox" name="moon10" value="1">10月
					<input type="checkbox" name="moon11" value="1">11月
					<input type="checkbox" name="moon12" value="1">12月
					</TD>
                </TR>
				<TR>
                    <TH class="l-cellsec"></TH>
                    <TD class="l-cellodd">
					<input type="checkbox" name="moneyNotax" value="1">金額（税抜き）
					<input type="checkbox" name="moon1Tax" value="1">金額（税込）
					<input type="checkbox" name="tax" value="1">税金
					
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
  
  $tisTable=isTabel($_POST['moneyNotax'],$_POST['moon1Tax'],$_POST['tax'],$_POST['moon1'],$_POST['moon2'],$_POST['moon3'],$_POST['moon4'],$_POST['moon5'],$_POST['moon6'],$_POST['moon7'],$_POST['moon8'],$_POST['moon9'],$_POST['moon10'],$_POST['moon11'],$_POST['moon12']);
  
  
  $sql_thquery="select name,sum(moo1),sum(moo2),sum(moo3),sum(moo4),sum(moo5),sum(moo6),sum(moo7),sum(moo8),sum(moo9),sum(moo10),sum(moo11),sum(moo12) from thquery  group by name";
  $res_thquery=mysql_query($sql_thquery,$db) or die ("db !!!");


}
echo $tisTable;?>

	</body>
	</html>