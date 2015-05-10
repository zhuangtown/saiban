<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);//shutdown error wwarining!!
session_start();
if(!isset($_SESSION["user_id"])){
	header("Location: error.php");
}
?>
<?php include('menubar.php'); ?>
<div id="head">
        <div id="title">
			<h1></h1>
			<TABLE WIDTH="100%" BORDER=0 CELLSPACING=4 CELLPADDING=0>
				<TR ALIGN="CENTER" WIDTH="">
					<TD WIDTH="5%"><IMG SRC='img/logo.png' BORDER='0'></TD>
					<TD WIDTH="65%"></TD>
					<TD ALIGN="left" HEIGHT="35" WIDTH="15%"></TD>
				</TR>
			</TABLE>
		</div>
	</div>

	<div class="list">
		<h3 align="center">
			<span style="color: darkslategray">システム設定</span></h3></div>
	
	<BR><BR><BR>
	<?php

	include_once './Includes/DBconnect.php';
	//DBへ接続
	$db=DBconnect();
	mysql_set_charset('sjis');
	

	$result=mysql_query("select name,postcode,address,tel,fax from setsys"); 
	$thsys=mysql_query("select shz from thsys");
	?>
	
	<div class="list">
		<table class="l-tbl">
			<col width="20%">
			<col width="15%">
			<col width="25%">
			<col width="15%">
			<col width="15%">
			<col width="10%">
			<TR>
				<TH class="l-cellcenter">会社名</TH>
				<TH class="l-cellcenter">郵便番号</TH>
				<TH class="l-cellcenter">住所</TH>
				<TH class="l-cellcenter">TEL</TH>
				<TH class="l-cellcenter">FAX</TH>
				<TH class="l-cellcenter">操作</TH>
				
				
			</TR>
			<?php
			while ($row=mysql_fetch_array($result)) {
				?>
			<TR>
		　　　　　　　<!-- 会社名 -->
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[0]?>" readonly=true
					style="background: transparent; border-width: 0px;width:200;font-weight:bold;color:steelblue">

				</TD>
				<!--郵便番号  -->
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[1]?>" readonly=true
					style="background: transparent; border-width: 0px; width: 100;font-weight:bold;color:steelblue">

				</TD>
					<!-- 住所 -->
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[2]?>" readonly=true
					style="background: transparent; border-width: 0px; width: 200;font-weight:bold;color:steelblue">

				</TD>
				
				<!--電話番号  -->
					<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[3]?>" readonly=true
					style="background: transparent; border-width: 0px; width: 100;font-weight:bold;color:steelblue">

				</TD>
					</TD>
				<!-- ファクス番号 -->
					<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[4]?>" readonly=true
					style="background: transparent; border-width: 0px; width: 100;font-weight:bold;color:steelblue">

				</TD>
				<!-- 変更 
					<TD class="l-cellodd"><input type="submit"
					value="<?php echo "変更"?>" action="setsystemEditWish.php"
					style="background: transparent; border-width: 0px; width: 100;font-weight:bold;color:steelblue;">

				</TD>-->
				<TD class="l-cellodd" >
		
					<form style='padding: 0px; margin: 0px;' name="setsystemEditWish"
								action="setsystemEditWish.php" method="GET">
								 <input TYPE="submit"
									name="editWish" VALUE="変更" class="i-btn">
							</form>
						<style="background: transparent; border-width: 0px; width: 100;font-weight:bold;color:steelblue" /TD></TR>  
			<?php
			}
			?>

		</table>
		</A>&nbsp
	</div>
		
		<div class="list">
		<table><TR><TD>
		<table class="l-tbl" >
			<col width=50px>
			<col width=50px>
		
			<TR>
				<TH class="l-cellcenter">消費税</TH>
				<TH class="l-cellcenter">操作</TH>
		　　</TR>
		<?php
			while ($rowthsys=mysql_fetch_array($thsys)) {
				?>
			<TR>
		　　　　　　　<!-- 消費税 -->
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $rowthsys[0]?>" readonly=true
					style="background: transparent; border-width: 0px;width:35;font-weight:bold;color:steelblue"></TD>

				<TD class="l-cellodd" >
		
					<form style='padding: 0px; margin: 0px;' name="shzchange"
								action="thsysedit.php" method="GET">
								 <input TYPE="submit"
									name="editWish" VALUE="変更" class="i-btn">
							</form>
						<style="background: transparent; border-width: 0px; width: 100;font-weight:bold;color:steelblue" /TD>
						</TR>  
			<?php
			}
			?>
		</table>
		</TR></TD></table>
</body>
</html>