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

                    <TD WIDTH="5%">

                    <TD WIDTH="65%"></TD>
					
				</TR>
			</TABLE>
		</div>
	</div>

	<div class="list">
		<h3 align="center">

			<span style="color: darkslategray">�������ꗗ</span>
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
	//DB�֐ڑ�
	$db=DBconnect();
	mysql_set_charset('sjis');
	
	$sql_year="SELECT DISTINCT DATE_FORMAT(updatetime,\"%Y\") FROM accountwork";
	$res_year=mysql_query($sql_year,$db) or die("DB putout error");
	
	//2014-10-30
	$sql_kind = "SELECT name FROM doctype";
    $res_kind = mysql_query($sql_kind, $db) or die("DB putout error");
	$sql_customer = "SELECT name FROM customer";
    $res_customer = mysql_query($sql_customer, $db) or die("DB putout error");
	//2014-10-30
	
	$result_doctype=mysql_query("select code,name from doctype"); 
	$result_dpt=mysql_query("select code,department from department"); 
	$result_cust=mysql_query("select code,name from customer"); 

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
	<form action=ordercheck.php method=post>
 <table class="l-tbl">
                <col width="20%">
                <col width="60%">
				 <TR>
                    <TH class="l-cellsec">���</TH>
                   <TD>������
                    </TD>
                </TR>
            <TR>
                    <TH class="l-cellsec">�N</TH>
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
                   <select name="oneMonth">
							<option value="">--</option>
							<option value="01">1��</option>
							<option value="02">2��</option>
							<option value="03">3��</option>
							<option value="04">4��</option>
							<option value="05">5��</option>
							<option value="06">6��</option>
							<option value="07">7��</option>
							<option value="08">8��</option>
							<option value="09">9��</option>
							<option value="10">10��</option>
							<option value="11">11��</option>
							<option value="12">12��</option>
						</select>
						</TD>
                </TR>
                <TR>
                    <TH class="l-cellsec">�����</TH>
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
                <TR> <th class="l-cellsec"><input type="submit" name="searchOk" value="����" class="m-btn" ></th>
				</TR>
				 
            </table>
      </form>
      
 <?php  if(isset($_POST['searchOk'])){
 $sql_order="SELECT saibanRes,buildDate,updatetime,user FROM `order` WHERE left(saibanRes,1)='T' AND DATE_FORMAT(buildDate,\"%Y";
 if($_POST['oneMonth']){
$sql_order .="%m\")='".$_POST['oneYear'].$_POST['oneMonth']."'";
 }else{
$sql_order .="\")='".$_POST['oneYear']."'";
 }
  $res_order=mysql_query($sql_order,$db) or die("DB error!!");

?>
	<div class="list">
		<p>&nbsp;</p>
					
		<table><TR><TD><?php if($_POST['inpCustomer']=="00"){echo $_POST['oneYear']."--������"; } else{echo $_POST['oneYear']."--������";}?></TD></TR></table>
		<table class="l-tbl">
		    <colgroup>
		    <col width="2%">
			<col width="20%">
			<col width="30%">
			<col width="20%">
			<col width="20%">
			</colgroup>
			<TR>
				<TH class="l-cellcenter">No.</TH>
				<TH class="l-cellcenter">�������ԍ�</TH>
				<TH class="l-cellcenter">��Ж�</TH>
				<TH class="l-cellcenter">�N����</TH>
				<TH class="l-cellcenter">�쐬�l</TH>
				<TH class="l-cellcenter">����</TH>
			</TR>				
		<?php 
		$i=1;
		while($row_order= mysql_fetch_array($res_order)){		
		?>
		<?php 
				$codeName=substr($row_order[0],8,3);
		         $sql_name = "SELECT `name` FROM `customer` WHERE `code`=".$codeName."";
                 $res_name = mysql_query($sql_name, $db) or die("DB putout name error");
				 $row_name=mysql_fetch_array($res_name)
					?>						
		<TR>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo $i ?>" readonly=true
					style="width:25px;text-align:center;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		
		<TD class="l-cellodd"><input type="text"
					value="<?php echo $row_order[0] ?>" readonly=true
					style="text-align:center;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		
			<TD class="l-cellodd"><input type="text"
					value="<?php echo $row_name[0] ?>" readonly=true
					style="width:250px; text-align:center;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		
		<TD class="l-cellodd"><input type="text"
					value="<?php echo $row_order[1] ?>" readonly=true
					style="text-align:center;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd"><input type="text"
					value="<?php echo $row_order[3] ?>" readonly=true
					style="text-align:center;background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
		</TD>
		<TD class="l-cellodd">		
		<table class="l-tbl">
						<TD>
							<form style='padding: 0px; margin: 0px;' �@name="viewto"
								action="orderEditWish.php" method="POST" target="_blank">
								<input type="hidden" name="saibanRes"
									value="<?php echo $row_order[0] ?>" /> <input TYPE="submit"
									name="editWish" VALUE="VIEW" ; class="i-btn">
							</form>
						</TD>
						<TD>
							<form style='padding: 0px; margin: 0px;' height=0�@name=
								"userDeleteWish" action="accountdelete.php"
								method="POST">
								<input type="hidden" name="saibanRes"
									value="<?php echo $row_order[0]; ?>" /> <input TYPE="submit"
									name="deleteWish" VALUE="�폜" class="i-btn">
							</form>
						</TD>
					</table>
		
		
		
		
		</TD>
		
		
		
		
        </TR>
       <?php $i++;}}
			
		?>
		</table>
		
		<TR>
		
	
		
</div>
		


</body>
</html>
