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
<!--                    <TD WIDTH="5%"><IMG SRC='img/ekintai1.gif' BORDER='0'>----2013/03/22���C----->
					<TD WIDTH="5%"><IMG SRC='img/logo.png' BORDER='0'></TD>
<!--					<TD WIDTH="95%"></TD>------2013/03/13���C------------------------------------->
					<TD WIDTH="65%"></TD>
					<TD ALIGN="left" HEIGHT="35" WIDTH="15%"></TD>
				</TR>
			</TABLE>
		</div>
	</div>

	<div class="list">
		<h3 align="center">
<!--			<span style="color: gray">Customer�}�X�^</span> 2013/03/13���C-->
			<span style="color: darkslategray">���[�U�[�}�X�^</span>
		</h3>
	
	</div>


	<!-- 2013/03/04�ǉ�--�����܂�--------------------------------->
	<BR><BR><BR>
	<?php

	include_once './Includes/DBconnect.php';
	//DB�֐ڑ�
	$db=DBconnect();
	$usersql="select `code`,`user_id`,`password` from user_master";
	$result=mysql_query($usersql,$db) or die("DB connect NG!");
	
	?>
	
	<div class="list" >
		<table class="userl-tbl">
			<col width="5%">
			<col width="15%">
			<col width="15%">
			<col width="15%">
			
			<TR>
				<TH class="l-cellcenter">No.</TH>
				<TH class="l-cellcenter">���[�U��</TH>
				<TH class="l-cellcenter">�p�X���[�h</TH>
				<TH class="l-cellcenter">����</TH>
				
			</TR>
			<?php
			while ($row=mysql_fetch_array($result)) {
				$wishID = $row["code"];
				?>
				<!--NO -->
					<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[0]?>" readonly=true
					style="background: transparent; border-width: 0px; width: 100;font-weight:bold;color:steelblue">

				</TD>
					</TD>
				<!-- ���[�U��-->
					<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[1]?>" readonly=true
					style="background: transparent; border-width: 0px; width: 100;font-weight:bold;color:steelblue">

				</TD>
				<!-- �p�X���[�h -->
					<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[2]?>" readonly=true
					style="background: transparent; border-width: 0px; width: 100;font-weight:bold;color:steelblue">

				</TD>
<!-- ------------------------------------------------------------------------------------------------------------------------------ -->
				<TD class="l-cellodd">
					<table class="l-tbl">
						<TD>
							<form style='padding: 0px; margin: 0px;' �@name="userEditWish"
								action="userEditWish.php" method="GET">
								<input type="hidden" name="wishID"
									value="<?php echo $wishID; ?>" /> <input TYPE="submit"
									name="editWish" VALUE="�ύX" class="i-btn">
							</form>
						</TD>
						<TD>
							<form style='padding: 0px; margin: 0px;' height=0�@name=
								"userDeleteWish" action="userDeleteWish.php"
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
	
		<form name="addNewWish" action="userEditWish.php">
			<input type="submit" value="�}�X�^�ǉ�" class="m-btn" />
		</form>
	</div>
</body>
</html>