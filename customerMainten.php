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
			<TABLE WIDTH="100%" BORDER=0 CELLSPACING=4 CELLPADDING=0>
				<TR ALIGN="CENTER" WIDTH="">

					<TD WIDTH="5%"><!--<IMG SRC='img/logo.png' BORDER='0'>--></TD>

					<TD WIDTH="65%"></TD>
					<TD ALIGN="left" HEIGHT="35" WIDTH="15%"></TD>
				</TR>
			</TABLE>
		</div>
	</div>

	<div class="list">
		<h3 align="center">
<!--			<span style="color: gray">Customer�}�X�^</span> 2013/03/13���C-->
			<span style="color: darkslategray">�����}�X�^</span>
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
	<!--	<BR>  -->
	</div>
	<!-- 2013/03/04�ǉ�--��������-------------------------------->
	<?php
	//2013/03/04�ǉ�--��������------------------------------------>
	if(isset($_POST['Type'])){
		$perNumber=$_POST['Type']; //���y�[�W�̕\������y�[�W��
		$Number=$_POST['Type'];
	}
	else{
		$perNumber=25;
	}
	//2013/03/04�ǉ�--�����܂�------------------------------------>
	?>
	<div id="disp" class="list">
<!--	<TABLE WIDTH="80" ALIGN="right" BORDER=0 CELLSPACING=4 CELLPADDING=0> 2013/03 ���C-->
		<TABLE   style=" width: 80px;" ALIGN="right" BORDER=0>
			<TR>
				<TH class="l-cellcenter">�R�[�h�\��</TH>
			</TR>
			<TR ALIGN="right" WIDTH="20px">
				<TD align="center">
					<form method="POST" action="customerMainten.php">
						<select name="Type" onChange="submit(this.form)">
							<option value="25">25��</option>
							<option value="50">50��</option>
							<option value="100">100��</option>
						</select>
					</form>
				</TD>
			</TR>
		</TABLE>
	</div>
	<!-- 2013/03/04�ǉ�--�����܂�--------------------------------->
	<BR><BR><BR>
	<?php

	include_once './Includes/DBconnect.php';
	//DB�֐ڑ�
	$db=DBconnect();
	mysql_set_charset('sjis');
	//<!-- 2013/03/04�ǉ�--��������-------------------------------->
	if(isset($_GET['perNumber'])){
		$perNumber=$_GET['perNumber']; //���y�[�W�̕\������y�[�W��
	}
	//<!-- 2013/03/04�ǉ�--�����܂�--------------------------------->
	//$page=$_GET['page']; //���O�̃y�[�W�������
	$count=mysql_query("select count(*) from customer"); //�����R�[�h��
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
	$result=mysql_query("select code,name,owner,mail,postcode,address,manager1,mail1,manager2,mail2,tel,fax from customer limit $startCount,$perNumber"); //
	?>
	<form style='padding: 0px; margin: 0px;' name="customerMainten"
		�@action="customerMainten.php" method="GET">
		<input type="hidden" name="page" value="<?php echo $page; ?>" />
	</form>
	<div class="list">
		<table class="l-tbl">
			<col width="15%">
			<col width="15%">
			<col width="15%">
			<col width="15%">
			<col width="15%">
			<col width="15%">
			<col width="15%">
			<col width="15%">
			<col width="15%">
			<col width="15%">
			<col width="15%">
			<col width="15%">
			<TR>
				<TH class="l-cellcenter">�����R�[�h</TH>
				<TH class="l-cellcenter">����於</TH>
				<TH class="l-cellcenter">��\</TH>
				<TH class="l-cellcenter">���[��</TH>
				<TH class="l-cellcenter">�X��</TH>
				<TH class="l-cellcenter">�Z��</TH>
			    <TH class="l-cellcenter">�S���P</TH>
				<TH class="l-cellcenter">���[��</TH>
				<TH class="l-cellcenter">�S���Q</TH>
				<TH class="l-cellcenter">���[��</TH>
				<TH class="l-cellcenter">�d�b</TH>
				<TH class="l-cellcenter">�t�@�N�X</TH>
				<TH class="l-cellcenter">����</TH>
				
			</TR>
			<?php
			while ($row=mysql_fetch_array($result)) {
				$wishID = $row["code"];
				?>
			<TR>
			<!-- �����ԍ� -->
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[0]?>" readonly=true
					style="background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
<!--				style="background: transparent; border-width: 0px">----2013/03/22���C----->
				</TD>
				<!-- ����於 -->
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[1]?>" readonly=true
					style="background: transparent; border-width: 0px; width: 200;font-weight:bold;color:steelblue">
<!-- 				style="background: transparent; border-width: 0px; width: 600">----2013/03/22���C----->
				</TD>
				<!-- ---------------------------------------------------------------------------------------------------- -->
				<!--��\  -->
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[2]?>" readonly=true
					style="background: transparent; border-width: 0px;width:100;font-weight:bold;color:steelblue">

				</TD>
				<!--��\���[��  -->
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[3]?>" readonly=true
					style="background: transparent; border-width: 0px;width:200;font-weight:bold;color:steelblue">

				</TD>
				<!--�X�֔ԍ�  -->
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[4]?>" readonly=true
					style="background: transparent; border-width: 0px;width:70;font-weight:bold;color:steelblue">

				</TD>
				<!--�Z��  -->
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[5]?>" readonly=true
					style="background: transparent; border-width: 0px;width:300;font-weight:bold;color:steelblue">

				</TD>
				<!-- �S���P -->
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[6]?>" readonly=true
					style="background: transparent; border-width: 0px;width:100;font-weight:bold;color:steelblue">

				</TD>
				<!-- �S���P�̃��[�� -->
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[7]?>" readonly=true
					style="background: transparent; border-width: 0px;width:200;font-weight:bold;color:steelblue">

				</TD>
				<!--�S���Q  -->
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[8]?>" readonly=true
					style="background: transparent; border-width: 0px; width: 100;font-weight:bold;color:steelblue">

				</TD>
					<!-- �S���Q�̃��[�� -->
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[9]?>" readonly=true
					style="background: transparent; border-width: 0px; width: 200;font-weight:bold;color:steelblue">

				</TD>
				<!--�d�b�ԍ�  -->
					<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[10]?>" readonly=true
					style="background: transparent; border-width: 0px; width: 100;font-weight:bold;color:steelblue">

				</TD>
					</TD>
				<!-- �t�@�N�X�ԍ� -->
					<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[11]?>" readonly=true
					style="background: transparent; border-width: 0px; width: 100;font-weight:bold;color:steelblue">

				</TD>
<!-- ------------------------------------------------------------------------------------------------------------------------------ -->
				<TD class="l-cellodd">
					<table class="l-tbl">
						<TD>
							<form style='padding: 0px; margin: 0px;' �@name="customerEditWish"
								action="customerEditWish.php" method="GET">
								<input type="hidden" name="wishID"
									value="<?php echo $wishID; ?>" /> <input TYPE="submit"
									name="editWish" VALUE="�ύX" class="i-btn">
							</form>
						</TD>
						<TD>
							<form style='padding: 0px; margin: 0px;' height=0�@name=
								"customerDeleteWish" action="customerDeleteWish.php"
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
		<!-----2013/3---���C<A href="customerMainten.php?page=<?php echo $page - 1;?>">�O�̃y�[�W</A>-------------------->
		<A href="customerMainten.php?page=<?php echo $page - 1;?>&perNumber=<?php echo $perNumber;?>">�O�̃y�[�W</A>
		<?php
		}
		if($totalPage > 1){
		    for ($i=1;$i<=$totalPage;$i++) {  //
		        if($page != $i){
		?>
		<!------2013/3---���C&nbsp<A href="customerMainten.php?page=<?php echo $i;?>"><?php echo $i ;?>------------------>
		&nbsp<A href="customerMainten.php?page=<?php echo $i;?>&perNumber=<?php echo $perNumber;?>"><?php echo $i ;?>
		</A>&nbsp
		<?php
		        }else{
		            echo "&nbsp" . $i . "&nbsp";
		        }
		    }
		}
		if ($page<$totalPage) { //
			?>
		<!------2013/3---���C&nbsp<A href="customerMainten.php?page=<?php echo $page + 1;?>">���̃y�[�W</A>--------------->
		&nbsp<A href="customerMainten.php?page=<?php echo $page + 1;?>&perNumber=<?php echo $perNumber;?>">���̃y�[�W</A>
		<?php
		}
		?>

		<form name="addNewWish" action="customerEditWish.php">
			<input type="submit" value="�}�X�^�ǉ�" class="m-btn" />
		</form>
	</div>
</body>
</html>