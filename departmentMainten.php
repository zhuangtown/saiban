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
            <TABLE WIDTH="100%" BORDER=0>
                <TR ALIGN="CENTER" WIDTH="">
                    <TD WIDTH="5%"><!--<IMG SRC='img/logo.png' BORDER='0'>-->
					<TD WIDTH="65%"></TD>
					<TD ALIGN="left" HEIGHT="35" WIDTH="15%"></TD>
				</TR>
			</TABLE>
		</div>
	</div>

	<div class="list">
		<h3 align="center">
<!--			<span style="color: gray">Department�}�X�^</span>  2013/03/13���C-->
			<span style="color: darkslategray">���ƕ��}�X�^</span>
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
	$perNumber=10; //���y�[�W�̕\������y�[�W��
	//$page=$_GET['page']; //���O�̃y�[�W�������
	$count=mysql_query("select count(*) from department"); //�����R�[�h��
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
	$result=mysql_query("select code,department,boss,manager1,manager2 from department order by code limit $startCount,$perNumber"); //
	?>
	<form style='padding: 0px; margin: 0px;' name="departmentMainten"
		�@action="departmentMainten.php" method="GET">
		<input type="hidden" name="page" value="<?php echo $page; ?>" />
	</form>
	<div class="list">
		<table class="l-tbl">
			<col width="15%">
			<col width="70%">
			<col width="15%">
			<col width="15%">
			<TR>
				<TH class="l-cellcenter">���ƕ��R�[�h</TH>
				<TH class="l-cellcenter">���ƕ�����</TH>
				<TH class="l-cellcenter">����</TH>
				<TH class="l-cellcenter">�S���P</TH>
				<TH class="l-cellcenter">�S���Q</TH>
				<TH class="l-cellcenter">����</TH>
			</TR>
			<?php
			while ($row=mysql_fetch_array($result)) {
				$wishID = $row["code"];
				?>
			<TR>
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[0]?>" readonly=true
					style="background: transparent; border-width: 0px;">
				</TD>
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[1]?>" readonly=true
					style="background: transparent; width:100;border-width: 0px; ">
				</TD>
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[2]?>" readonly=true
					style="background: transparent;width:100; border-width: 0px; ">
				</TD>
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[3]?>" readonly=true
					style="background: transparent; width:100;border-width: 0px; ">
				</TD>
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[4]?>" readonly=true
					style="background: transparent; width:100;border-width: 0px; ">
				</TD>

				<TD class="l-cellodd">
					<table class="l-tbl">
						<TD>
							<form style='padding: 0px; margin: 0px;'
								�@name="departmentEditWish" action="departmentEditWish.php"
								method="GET">
								<input type="hidden" name="wishID"
									value="<?php echo $wishID; ?>" /> <input TYPE="submit"
									name="editWish" VALUE="�ύX" class="i-btn">
							</form>
						</TD>
						<TD>
							<form style='padding: 0px; margin: 0px;' height=0�@name=
								"departmentDeleteWish" action="departmentDeleteWish.php"
								method="POST">
								<input type="hidden" name="wishID"
									value="<?php echo $wishID; ?>" /> <input TYPE="submit"
									name="deleteWish" VALUE="�폜" class="i-btn">
							</form>
						</TD>
					</table></TD>
			</TR>
			<?php
			}
			?>

		</table>

		<?php
		if ($page != 1) { //
			?>
		<A href="departmentMainten.php?page=<?php echo $page - 1;?>">�O�̃y�[�W</A>
		<?php
		}
		if($totalPage > 1){
		    for ($i=1;$i<=$totalPage;$i++) {  //
		        if($page != $i){
		?>
		&nbsp<A href="departmentMainten.php?page=<?php echo $i;?>"><?php echo $i ;?>
		</A>&nbsp
		<?php
		        }else{
		            echo "&nbsp" . $i . "&nbsp";
		        }
		    }
		}
		if ($page<$totalPage) { //
			?>
		&nbsp<A href="departmentMainten.php?page=<?php echo $page + 1;?>">���̃y�[�W</A>
		<?php
		}
		?>

		<form name="addNewWish" action="departmentEditWish.php">
			<input type="submit" value="�}�X�^�ǉ�" class="m-btn" />
		</form>
	</div>
</body>
</html>
