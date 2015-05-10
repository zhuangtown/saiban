<?php
session_start();
if(!isset($_SESSION["user_id"])){
	header("Location: error.php");
}
?>
<?php include('menubar.php'); ?>
<div id="head">
        <div id="title">
			<h1></h1>
<!--            <TABLE WIDTH="100%" BORDER=0 CELLSPACING=4 CELLPADDING=0>----2013/03/22改修----->
            <TABLE WIDTH="100%" BORDER=0>
                <TR ALIGN="CENTER" WIDTH="">
<!--                    <TD WIDTH="5%"><IMG SRC='img/ekintai1.gif' BORDER='0'>----2013/03/22改修----->
                    <TD WIDTH="5%"><IMG SRC='img/logo.png' BORDER='0'>
<!--                <TD WIDTH="95%"></TD>------2013/03/13改修------------------------------------->
                    <TD WIDTH="65%"></TD>
					<TD ALIGN="left" HEIGHT="35" WIDTH="15%"></TD>
				</TR>
			</TABLE>
		</div>
	</div>

	<div class="list">
		<h3 align="center">
<!-- 			<span style="color: gray">Filemanマスタ</span>-------2013/03/15改修-------------->
			<span style="color: darkslategray">帳票一覧</span>
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
	//DBへ接続
	$db=DBconnect();
	mysql_set_charset('sjis');
	
	//2014-10-30
	$sql_kind = "SELECT name FROM doctype";
    $res_kind = mysql_query($sql_kind, $db) or die("DB putout error");
	$sql_customer = "SELECT name FROM customer";
    $res_customer = mysql_query($sql_customer, $db) or die("DB putout error");
	//2014-10-30
	$perNumber=20; //毎ページの表示するページ数
	//$page=$_GET['page']; //当前のページ数を取る
	$count=mysql_query("select count(*) from fileman"); //総レコード数
	$rs=mysql_fetch_array($count);
	$totalNumber=$rs[0];
	$totalPage=ceil($totalNumber/$perNumber); //ページ数を計算する
	if (isset($_GET['page'])) {
		//$page=1;//値がない場合、１を
		$page=$_GET['page']; //当前のページ数を取る
	}
	else{
		//$page=$_GET['page']; //当前のページ数を取る
		$page=1;//値がない場合、１を
	}
	$startCount=($page-1)*$perNumber; //
	$result=mysql_query("select seqno,typecode,depcode,custcode from fileman limit $startCount,$perNumber"); //
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
		//$arr_cust=array("code"=>$row_cust["code"],"name"=>$row_cust["name"]);
		$arr_cust[$row_cust["code"]]=$row_cust["name"];
	}

	?>
	<form action=filemanMainthen.php method=post>
	  <BR>
      <div class="list"></div>
</form>
	<form style='padding: 0px; margin: 0px;' name="customerMainten"
		　action="customerMainten.php" method="GET">
		<input type="hidden" name="page" value="<?php echo $page; ?>" />
	</form>
	<div class="list">
		<table class="l-tbl">
			<col width="15%">
			<col width="10%">
			<col width="20%">
			<col width="45%">
			<col width="10%">
			<TR>
				<TH class="l-cellcenter">採番番号</TH>
				<TH class="l-cellcenter">種類</TH>
				<TH class="l-cellcenter">事業部</TH>
				<TH class="l-cellcenter">お客様コード</TH>
				<TH class="l-cellcenter">操作</TH>
			</TR>
			<?php
			while ($row=mysql_fetch_array($result)) {
				//$wishID = $row["code"];
				?>
			<TR>
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[0] ?>" readonly=true
					style="background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
<!--					style="background: transparent; border-width: 0px; width: 100%">----2013/03/22改修----->
				</TD>
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[1].":".$arr_doctype[$row[1]] ?>"
					readonly=true
					style="background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
<!--					style="background: transparent; border-width: 0px; width: 100%">----2013/03/22改修----->
				</TD>
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[2].":".$arr_dpt[$row[2]] ?>" readonly=true
					style="background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
<!--					style="background: transparent; border-width: 0px; width: 100%">----2013/03/22改修----->
				</TD>
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[3] .":".$arr_cust[$row[3]]?>" readonly=true
					style="background: transparent; border-width: 0px;width:300;font-weight:bold;color:steelblue">
<!--					style="background: transparent; border-width: 0px; width: 100%">----2013/03/22改修----->
				</TD>
				<TD class="l-cellodd">
					<table class="l-tbl">
<!-- 2013/03/04追加--ここから-------------------------------->
						<TD>
							<form style='padding: 0px; margin: 0px;'
								　name="filemanEditWish" action="OrderEdit.php?saiban_res=<?php echo $row[0] ?>"
								method="POST">
								<input type="hidden" name="seqNo"
									value="<?php echo $row[0]; ?>" /> <input TYPE="submit"
									name="editWish" VALUE="変更" class="i-btn">
							</form>
						</TD>
<!-- 2013/03/04追加--ここまで--------------------------------->
						<TD >
							<form style='padding: 0px; margin: 0px;' height=0　name=
								"filemanDelete" action="filemanDelete.php" method="POST">
								<input type="hidden" name="seqNo" value="<?php echo $row[0]; ?>" />
								<input TYPE="submit" name="deleteSeqNo" VALUE="削除" class="i-btn">
							</form>
						</TD>
<!----------------------------------------------- 2014-10-29------------------------------ -->
						<TD >
							<form style='padding: 0px; margin: 0px;' height=0　name=
								"filemanwatch" target="_blank" action="filemanwatch.php" method="POST">
								<input type="hidden" name="seqNo" value="<?php echo $row[0]; ?>" />
								<input TYPE="submit" name="pdfwatch" VALUE="帳票" class="i-btn">
							</form>
						</TD>
<!------------------------------- 2014-10-29 ---------------------------------------------------------->
					</table>
				</TD>
			</TR>
			<?php
			}
			?>

		</table>

		<?php
		if ($page != 1) { //
			?>
		<A href="filemanten.php?page=<?php echo $page - 1;?>&perNumber=20">前のージ</A>
		<?php
		}
		if($totalPage > 1){
		    for ($i=1;$i<=$totalPage;$i++) {  //
		?>
		&nbsp<A href="filemanten.php?page=<?php echo $i;?>&perNumber=20"><?php echo $i ;?>
		</A>&nbsp
		<?php
		    }
		}
		if ($page<$totalPage) { //
			?>
		&nbsp<A href="filemanten.php?page=<?php echo $page + 1;?>&perNumber=20">次のページ</A>
		<?php
		}
		?>
	</div>
</body>
</html>
