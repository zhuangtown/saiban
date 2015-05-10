
<head>
<style type="text/css">
.auto-style2 {
	text-align: center;
	color: #FFFFFF;
	font-size: large;
}
.auto-style3 {
	text-align: center;
}
.auto-style5 {
	text-align: center;
	font-size: x-small;
	color: #644B9D;
}
.auto-style12 {
	border-width: 0px;
}
</style>
</head>
<html>
<body>
<?php
include_once './Includes/DBconnect.php';
//DBへ接続
$db=DBconnect();
//DBの選択
mysql_set_charset('sjis');
session_start();
if(!isset($_SESSION["user_id"])){
	header("Location: Login.php");
}else{
	$user_id=$_SESSION["user_id"];
	$sql_user="SELECT  `saiban`, `deparment`, `customer`, `doctype`, `usermaster`, `system` FROM `user_master` WHERE user_id='".$user_id."'";
	$res_user=mysql_query($sql_user,$db) or die("menu DB output error!");
	while($row_user=mysql_fetch_array($res_user)){
		$saiban=$row_user[0];
		$deparment=$row_user[1];
		$customer=$row_user[2];
		$doctype=$row_user[3];
		$usermaster=$row_user[4];
		$system=$row_user[5];
	}
	
}
?>

<?php include('menubar.php'); ?>
	<div id="head">
		<div id="title">
			<h1></h1>
<!--			<TABLE WIDTH="100%" BORDER=0 CELLSPACING=4 CELLPADDING=0>----2013/03/14改修----->
			<div id="reiya1" style="position: absolute; width: 278px; height: 252px; z-index: 1; left: 144px; top: 143px; background-color: #D9FFFF">
				<table style="width: 100%; height: 42px; background-color: #FF9900; color: #FFFFFF;" >					<tr>
						<td class="auto-style2" style="width: 347px"><strong>種類作成</strong></td>
					</tr>
				</table>
				<table style="width: 100%; height: 171px;">
					<tr>
						<td class="auto-style3" style="width: 154px">
						<a href="quotationsaiban.php">
						<img alt="" height="70" src="img/file.png" width="70" class="auto-style12"></a></td>
						<td class="auto-style3" style="width: 129px">
						<a href="ordersaiban.php">
						<img alt="" height="70" src="img/file9.png" width="70" class="auto-style12"></a></td>
					</tr>
					<tr>
						<td class="auto-style5" style="width: 154px; height: 18px;"><strong>
						見積書作成</strong></td>
						<td class="auto-style5" style="width: 129px; height: 18px;"><strong>
						注文書作成</strong></td>
					</tr>
					<tr>
						<td class="auto-style3" style="width: 154px; height: 91px;">
						<a href="accountsaiban.php">
						<img alt="" height="70" src="img/file14.png" width="70" class="auto-style12"></a></td>
						<td class="auto-style3" style="width: 129px; height: 91px;">
						<a href="immature.php">
						<img alt="" height="70" src="img/file8.png" width="70" class="auto-style12"></a></td>
					</tr>
					<tr>
						<td class="auto-style5" style="width: 154px"><strong>
						請求書作成</strong></td>
						<td class="auto-style5" style="width: 129px"><strong>
						注文請書作成</strong></td>
					</tr>
				</table>
</div>
						<div id="reiya2" style="position: absolute; width: 278px; height: 252px; z-index: 2;  left: 483px; top: 143px; background-color: #D9FFFF; right: 334px;">
							<table style="width: 100%; height: 42px; background-color: #FF9900; color: #FFFFFF;" >					<tr>
						<td class="auto-style2" style="width: 347px"><strong>積計分析</strong></td>
					</tr>
				</table>
							<table style="width: 100%; height: 171px;">
					<tr>
						<td class="auto-style3" style="width: 154px">
						<a href="quotationcheck.php">
						<img alt="" height="70" src="img/file3.png" width="70" class="auto-style12"></a></td>
						<td class="auto-style3" style="width: 129px">
						<a href="ordercheck.php">
						<img alt="" height="70" src="img/file24.png" width="70" class="auto-style12"></a></td>
					</tr>
					<tr>
						<td class="auto-style5" style="width: 154px; height: 18px;"><strong>
						見積書一覧</strong></td>
						<td class="auto-style5" style="width: 129px; height: 18px;"><strong>
						注文書一覧</strong></td>
					</tr>
					<tr>
						<td class="auto-style3" style="width: 154px; height: 91px;">
						<a href="accountcost.php">
						<img alt="" height="70" src="img/file5.png" width="70" class="auto-style12"></a></td>
						<td class="auto-style3" style="width: 129px; height: 91px;">
						<a href="immature.php">
						<img alt="" height="70" src="img/file4.png" width="70" class="auto-style12"></a></td>
					</tr>
					<tr>
						<td class="auto-style5" style="width: 154px"><strong>
						請求書一覧</strong></td>
						<td class="auto-style5" style="width: 129px"><strong>
						注文受書一覧</strong></td>
					</tr>
				</table>
					</div>
			<TABLE WIDTH="100%" BORDER=0>
				<TR ALIGN="CENTER" WIDTH="">
<!--					<TD WIDTH="5%"><IMG SRC='img/ekintai1.gif' BORDER='0'>----2013/03/14改修----->
					<TD WIDTH="5%"><!--<IMG SRC='img/logo.png' BORDER='0'> -->
					</TD>
					<TD WIDTH="95%"></TD>
					
				</TR>
			</TABLE>
	
<div style="postion:absolute;
left:50%;
right:50%;
margin-left:450px;
margin-top:30px;
font-size:45px;
font-family:HGS明朝B;
 color:rgb(100,75,157);
font-weight:500;">
	e営業支援システム<br></div>

		</div>
	</div>
	

					<div id="reiya3"  style="position: absolute; width: 278px; height: 252px;  z-index: 3; left: 815px; top: 143px; background-color: #D9FFFF">
						
						<table style="width: 100%; height: 42px; background-color: #FF9900; color: #FFFFFF;" >					<tr>
						<td class="auto-style2" style="width: 347px"><strong>PJ管理</strong></td>
					</tr>
				</table>
						<table style="width: 100%; height: 171px;">
					<tr>
						<td class="auto-style3" style="width: 154px">
						<a href="immature.php">
						<img alt="" height="70" src="img/file22.png" width="70" class="auto-style12"></a></td>
						<td class="auto-style3" style="width: 129px">
						<a href="immature.php">
						<img alt="" height="70" src="img/file18.png" width="70" class="auto-style12"></a></td>
					</tr>
					<tr>
						<td class="auto-style5" style="width: 154px; height: 18px;"><strong>
						新規ＰＪ追加</strong></td>
						<td class="auto-style5" style="width: 129px; height: 18px;"><strong>
						ＰＪ一覧</strong></td>
					</tr>
					<tr>
						<td class="auto-style3" style="width: 154px; height: 91px;">
						&nbsp;</td>
						<td class="auto-style3" style="width: 129px; height: 91px;">
						&nbsp;</td>
					</tr>
					<tr>
						<td class="auto-style5" style="width: 154px">&nbsp;</td>
						<td class="auto-style5" style="width: 129px">&nbsp;</td>
					</tr>
				</table>
				</div>
				
				
				
			
				
				
												
<div id="reiya4" style="position: absolute; width: 278px; height: 252px; z-index: 4; left: 144px; top: 412px; background-color: #D9FFFF">
<table style="width: 100%; height: 42px; background-color: #FF9900; color: #FFFFFF;">					<tr>
						<td class="auto-style2" style="width: 347px"><strong>システム管理</strong></td>
					</tr>
				</table>
				<table style="width: 100%; height: 171px;">
					<tr>
						<td class="auto-style3" style="width: 154px">
						<a href="userMainten.php">
						<img alt="" height="70" src="img/file19.png" width="70" class="auto-style12"></a></td>
						<td class="auto-style3" style="width: 129px">
						<a href="setsystem.php">
						<img alt="" height="70" src="img/file26.png" width="70" class="auto-style12"></a></td>
					</tr>
					<tr>
						<td class="auto-style5" style="width: 154px; height: 18px;"><strong>
						ユーザー設定</strong></td>
						<td class="auto-style5" style="width: 129px; height: 18px;"><strong>
						システム設定</strong></td>
					</tr>
					<tr>
						<td class="auto-style3" style="width: 154px; height: 91px;">
						&nbsp;</td>
						<td class="auto-style3" style="width: 129px; height: 91px;">
						&nbsp;</td>
					</tr>
					<tr>
						<td class="auto-style5" style="width: 154px">&nbsp;</td>
						<td class="auto-style5" style="width: 129px">&nbsp;</td>
					</tr>
				</table>

</div>
<div id="reiya5" style="position: absolute; width: 278px; height: 252px; z-index: 5; left: 483px; top: 412px; background-color: #D9FFFF">
<table style="width: 100%; height: 42px; background-color: #FF9900; color: #FFFFFF;">					<tr>
						<td class="auto-style2" style="width: 347px"><strong>社内情報</strong></td>
					</tr>
				</table>
				<table style="width: 100%; height: 171px;">
					<tr>
						<td class="auto-style3" style="width: 154px">
						<a href="departmentMainten.php">
						<img alt="" height="70" src="img/file20.png" width="70" class="auto-style12"></a></td>
						<td class="auto-style3" style="width: 129px">
						<a href="customerMainten.php">
						<img alt="" height="70" src="img/file21.png" width="70" class="auto-style12"></a></td>
					</tr>
					<tr>
						<td class="auto-style5" style="width: 154px; height: 18px;"><strong>
						事業部情報</strong></td>
						<td class="auto-style5" style="width: 129px; height: 18px;"><strong>
						取引先情報</strong></td>
					</tr>
					<tr>
						<td class="auto-style3" style="width: 154px; height: 91px;">
						<a href="workMerberlist.php?delete=0">
						<img alt="" height="70" src="img/file113.png" width="70" class="auto-style12"></a></td>
						<td class="auto-style3" style="width: 129px; height: 91px;">
						&nbsp;</td>
					</tr>
					<tr>
						<td class="auto-style5" style="width: 154px"><strong>
						社員情報</strong></td>
						<td class="auto-style5" style="width: 129px">&nbsp;</td>
					</tr>
				</table>

</div>

<div id="reiya6" style="position: absolute; width: 278px; height: 252px; z-index: 6; left: 815px; top: 412px; background-color: #D9FFFF">
<table style="width: 100%; height: 42px; background-color: #FF9900; color: #FFFFFF;">					<tr>
						<td class="auto-style2" style="width: 347px"><strong>送信ツール</strong></td>
					</tr>
				</table>
				<table style="width: 100%; height: 171px;">
					<tr>
						<td class="auto-style3" style="width: 154px">
						<a href="autooppadd.php">
						<img alt="" height="70" src="img/file27.png" width="70" class="auto-style12"></a></td>
						<td class="auto-style3" style="width: 129px">
						<a href="immature.php">
						<img alt="" height="70" src="img/file15.png" width="70" class="auto-style12"></a></td>
					</tr>
					<tr>
						<td class="auto-style5" style="width: 154px; height: 18px;"><strong>
						案件情報登録</strong></td>
						<td class="auto-style5" style="width: 129px; height: 18px;"><strong>
						技術者紹介登録</strong></td>
					</tr>
					<tr>
						<td class="auto-style3" style="width: 154px; height: 91px;">
						<a href="autooppsend.php">
						<img alt="" height="70" src="img/file10.png" width="70" class="auto-style12"></a></td>
						<td class="auto-style3" style="width: 129px; height: 91px;">
						<a href="immature.php">
						<img alt="" height="70" src="img/file25.png" width="70" class="auto-style12"></a></td>
					</tr>
					<tr>
						<td class="auto-style5" style="width: 154px"><strong>
						案件情報送</strong></td>
						<td class="auto-style5" style="width: 129px"><strong>
						技術者提案送信</strong></td>
					</tr>
				</table>

</div>


				
				
				
			
				
				
</body>												
					

</html>

