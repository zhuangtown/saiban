<?php

include_once './Includes/DBconnect.php';
//DB�֐ڑ�
$db=DBconnect();
//DB�̑I��

mysql_set_charset('sjis');

session_start();

$error_message = "";
$login_flag=true;
unset($_SESSION["user_id"]);
// ���O�C���C�x���g
if (isset($_POST['login'])) {
	//unset($_SESSION['ticket']);

	//if( !$_SESSION['execute'] ) {

	$user_id=($_POST['user_id']);
	$password=($_POST['password']);

	if($user_id==null){
		$error_message="���[�U�[������͂��Ă��������B";
		$login_flag=false;
	}

	if($password==null){
		$error_message=$error_message."<br>�p�X���[�h����͂��Ă��������B";
		$login_flag=false;
	}

	if($login_flag){
		$sql_user_info="SELECT * FROM user_master WHERE user_id='".  $user_id."' AND password='".$password."'";
		$res_user_info = mysql_query($sql_user_info, $db) or die("DB putout error");
		$res_user_info_array=mysql_fetch_array($res_user_info);
		if($res_user_info_array[0]==""){
			$error_message="���[�U���������̓p�X���[�h������Ă��܂��B";
			$login_flag=false;
		}

		if($login_flag){
			$_SESSION["user_id"] = $_POST["user_id"];
			//$login_url = "http://{$_SERVER["HTTP_HOST"]}/workspace/SAIBAN/customerMainten.php";
			header('Location: Menu.php');
			exit;
		}
	}

	//		$_SESSION['execute'] = true;
	//	}
}
?>
<html>
<head>
<title>
���󔭒��V�X�e��
</title>
<div id="head">
<meta http-equiv="Content-Style-Type" content="text/css">
<link href="css/common.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/demo.css" />
<link rel="stylesheet" type="text/css" href="js/menu/fixedMenu_style1.css" />
</head>
<body>
        <div id="title">
			<h1></h1>
			<TABLE WIDTH="100%" BORDER=0>
				<TR ALIGN="CENTER" WIDTH="">
					<TD WIDTH="5%"><IMG SRC='img/logo.png' BORDER='0'>
					</TD>
					<TD WIDTH="95%"></TD>
				</TR>
			</TABLE>
		</div>
	</div>
	<form action="Login.php" method="post">
		<div class="list" align="center">
			<h3 align="center">
�@�@�@�@�@�@<span style="color: #0000FF;font-size:20px;">���󔭒��V�X�e��</span><br><br>
				<span style="font-size:15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
				</span><span style="color: darkslategray">���O�C��</span>
			</h3>
			<?php
			if ($error_message) {
				print '<font color="red">'.$error_message.'</font>';
			}
			?>
			<table class="l-tbl" style="width: 30%">
				<col width="10%">
				<col width="20%">
				<TR>
					<TH class="l-cellsec">���[�U�[��</TH>
					<TD class="l-cellodd"><input type="text" name="user_id"
						style="width: 200px;">
					</TD>
				</TR>
				<TR>
					<TH class="l-cellsec">�p�X���[�h</TH>
					<TD class="l-cellodd"><input type="password" name="password"
						style="width: 200px;">
					</TD>
				</TR>
			</table>
			<BR> <input type="submit" value="���O�C��" name="login" class="m-btn" />
			<input type="reset" value="���Z�b�g" name="reset" class="m-btn" />
		</div>
	</form>
</body>
</html>
