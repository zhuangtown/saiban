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
<!--            <TABLE WIDTH="100%" BORDER=0 CELLSPACING=4 CELLPADDING=0>----2013/03/22���C----->
            <TABLE WIDTH="100%" BORDER=0>
                <TR ALIGN="CENTER" WIDTH="">
<!--                    <TD WIDTH="5%"><IMG SRC='img/ekintai1.gif' BORDER='0'>----2013/03/22���C----->
                    <TD WIDTH="5%"><IMG SRC='img/logo.png' BORDER='0'>
<!--                <TD WIDTH="95%"></TD>------2013/03/13���C------------------------------------->
                    <TD WIDTH="65%"></TD>
					<TD ALIGN="left" HEIGHT="35" WIDTH="15%"></TD>
				</TR>
			</TABLE>
		</div>
	</div>

	<div class="list">
		<h3 align="center">
<!-- 			<span style="color: gray">Fileman�}�X�^</span>-------2013/03/15���C-------------->
			<span style="color: darkslategray">���[�ꗗ</span>
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
	//DB�֐ڑ�
	$db=DBconnect();
	mysql_set_charset('sjis');
	
	//2014-10-30
	$sql_kind = "SELECT name FROM doctype";
    $res_kind = mysql_query($sql_kind, $db) or die("DB putout error");
	$sql_customer = "SELECT name FROM customer";
    $res_customer = mysql_query($sql_customer, $db) or die("DB putout error");
	//2014-10-30
	$perNumber=20; //���y�[�W�̕\������y�[�W��
	//$page=$_GET['page']; //���O�̃y�[�W�������
	$count=mysql_query("select count(*) from fileman"); //�����R�[�h��
	$rs=mysql_fetch_array($count);
	$totalNumber=$rs[0];
	$totalPage=ceil($totalNumber/$perNumber); //�y�[�W�����v�Z����
	if (isset($_GET['page'])) {
		//$page=1;//�l���Ȃ��ꍇ�A�P��
		$page=$_GET['page']; //���O�̃y�[�W�������
	}
	else{
		//$page=$_GET['page']; //���O�̃y�[�W�������
		$page=1;//�l���Ȃ��ꍇ�A�P��
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
		�@action="customerMainten.php" method="GET">
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
				<TH class="l-cellcenter">�̔Ԕԍ�</TH>
				<TH class="l-cellcenter">���</TH>
				<TH class="l-cellcenter">���ƕ�</TH>
				<TH class="l-cellcenter">���q�l�R�[�h</TH>
				<TH class="l-cellcenter">����</TH>
			</TR>
			<?php
			while ($row=mysql_fetch_array($result)) {
				//$wishID = $row["code"];
				?>
			<TR>
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[0] ?>" readonly=true
					style="background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
<!--					style="background: transparent; border-width: 0px; width: 100%">----2013/03/22���C----->
				</TD>
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[1].":".$arr_doctype[$row[1]] ?>"
					readonly=true
					style="background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
<!--					style="background: transparent; border-width: 0px; width: 100%">----2013/03/22���C----->
				</TD>
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[2].":".$arr_dpt[$row[2]] ?>" readonly=true
					style="background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
<!--					style="background: transparent; border-width: 0px; width: 100%">----2013/03/22���C----->
				</TD>
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[3] .":".$arr_cust[$row[3]]?>" readonly=true
					style="background: transparent; border-width: 0px;width:300;font-weight:bold;color:steelblue">
<!--					style="background: transparent; border-width: 0px; width: 100%">----2013/03/22���C----->
				</TD>
				<TD class="l-cellodd">
					<table class="l-tbl">
<!-- 2013/03/04�ǉ�--��������-------------------------------->
						<TD>
							<form style='padding: 0px; margin: 0px;'
								�@name="filemanEditWish" action="OrderEdit.php?saiban_res=<?php echo $row[0] ?>"
								method="POST">
								<input type="hidden" name="seqNo"
									value="<?php echo $row[0]; ?>" /> <input TYPE="submit"
									name="editWish" VALUE="�ύX" class="i-btn">
							</form>
						</TD>
<!-- 2013/03/04�ǉ�--�����܂�--------------------------------->
						<TD >
							<form style='padding: 0px; margin: 0px;' height=0�@name=
								"filemanDelete" action="filemanDelete.php" method="POST">
								<input type="hidden" name="seqNo" value="<?php echo $row[0]; ?>" />
								<input TYPE="submit" name="deleteSeqNo" VALUE="�폜" class="i-btn">
							</form>
						</TD>
<!----------------------------------------------- 2014-10-29------------------------------ -->
						<TD >
							<form style='padding: 0px; margin: 0px;' height=0�@name=
								"filemanwatch" target="_blank" action="filemanwatch.php" method="POST">
								<input type="hidden" name="seqNo" value="<?php echo $row[0]; ?>" />
								<input TYPE="submit" name="pdfwatch" VALUE="���[" class="i-btn">
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
		<A href="filemanten.php?page=<?php echo $page - 1;?>&perNumber=20">�O�́[�W</A>
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
		&nbsp<A href="filemanten.php?page=<?php echo $page + 1;?>&perNumber=20">���̃y�[�W</A>
		<?php
		}
		?>
	</div>
</body>
</html>
