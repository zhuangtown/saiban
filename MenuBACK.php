<?php
include_once './Includes/DBconnect.php';
//DB�֐ڑ�
$db=DBconnect();
//DB�̑I��
mysql_set_charset('sjis');
session_start();
if(!isset($_SESSION["user_id"])){
	header("Location: error.php");
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
<!--			<TABLE WIDTH="100%" BORDER=0 CELLSPACING=4 CELLPADDING=0>----2013/03/14���C----->
			<TABLE WIDTH="100%" BORDER=0>
				<TR ALIGN="CENTER" WIDTH="">
<!--					<TD WIDTH="5%"><IMG SRC='img/ekintai1.gif' BORDER='0'>----2013/03/14���C----->
					<TD WIDTH="5%"><IMG SRC='img/logo.png' BORDER='0'>
					</TD>
					<TD WIDTH="95%"></TD>
					<TD><INPUT TYPE="BUTTON" VALUE="���O�A�E�g"
						onClick="location.href='Login.php'" class="i-btn"></TD>
				</TR>
			</TABLE>
		</div>
	</div>

	<div class="list">
		<h3 align="center">
<!--			<span style="color: gray">�̔ԃV�X�e�����j���[</span>----2013/03/13���C---------->
			<span style="color: darkslategray">�󔭒����ރV�X�e�����j���[</span>
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
		<BR> <?php if($saiban=="T"){?><input type="button" onclick="location.href='Saiban.php'"
			value="�󔭒����ލ쐬" class="m-btn" />
			<?php }else{}?>
			 <?php if($deparment=="T"){?><input type="button"
			onclick="location.href='departmentMainten.php'" value="���ƕ��}�X�^"
			class="m-btn" /> <?php }else{}?>
			<?php if($customer=="T"){?><input type="button"
			onclick="location.href='customerMainten.php'" value="�����}�X�^"
			class="m-btn" /> <?php }else{}?>
			<?php if($doctype=="T"){?><input type="button"
			onclick="location.href='filemanMainten.php'" value="�󔭒����ވꗗ"
			class="m-btn" /><?php }else{}?>
			<?php if($usermaster=="T"){?><input type="button" onclick="location.href='userMainten.php'" value="���[�U�[�}�X�^"
			class="m-btn"/><?php }else{}?>
			<?php if($system=="T"){?><input type="button" onclick="location.href='setsystem.php'" value="�V�X�e���ݒ�"
			class="m-btn"/><?php }else{}?>
			<input type="button" onclick="location.href='fileMainten.php'"
			value="�쐬PDF�ꗗ" class="m-btn" />
	</div>
</body>
</html>

