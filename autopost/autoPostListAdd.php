<!-------------------------------------------------------------2015/02/06�V�K------------------------------------->
<?php
session_start ();
if (! isset ( $_SESSION ["user_id"] )) {
	header ( "Location: error.php" );
}
?>

<?php

if ($_POST ["edit"]) {

 $company=$_POST["company"];
 $manager=$_POST["manager"];
 $email=$_POST["email"];
 $zip_code=$_POST["zip_code"];
 $address=$_POST["address"];
 $tel=$_POST["tel"];
 $mobile=$_POST["mobile"];
 $post_result=$_POST["post_result"];
 $other=$_POST["other"];

	// DB�֐ڑ�
	include_once '../Includes/DBconnect.php';
	$db = DBconnect ();

	mysql_set_charset ( 'sjis' );

	 $usersql = "INSERT INTO auto_post (  company,
                                          manager, email, zip_code, address, tel,
                                          mobile, post_result, other) VALUES ( '$company', '$manager',
                                             '$email','$zip_code','$address','$tel','$mobile','$post_result',
                                             '$other')";

	$result = mysql_query ( $usersql, $db ) or die ( "DB connect die!" );
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Shift-JIS">
<meta http-equiv="Content-Style-Type" content="text/css">
<link href="css/common.css" rel="stylesheet" type="text/css">
<TITLE>���j���[</TITLE>
</head>
<body id="doc">
	<div id="head">
		<div id="title">
			<h1></h1>
			<TABLE WIDTH="100%" BORDER=0 CELLSPACING=4 CELLPADDING=0>
				<TR ALIGN="CENTER" WIDTH="">
					<TD WIDTH="5%"><IMG SRC='img/logo.png' BORDER='0'></TD>
					<TD WIDTH="95%"></TD>
					<TD ALIGN="left" HEIGHT="35" WIDTH="15%"><INPUT TYPE="BUTTON"
						VALUE="���j���[" onClick="location.href='Menu.php'" class="i-btn"><INPUT
						TYPE="BUTTON" VALUE="���O�A�E�g" onClick="location.href='Login.php'"
						class="i-btn"></TD>
				</TR>
			</TABLE>
		</div>
	</div>

	<div class="list">
		<h3 align="center">
			<span style="color: gray">�Č����ǉ�</span>
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

	<form name="autoPostListAdd" action="<?php $_SERVER["PHP_SELF"] ?>"
		method="POST">
		<input type="hidden" name="edit" value="1" />
		<div class="list">
			<table class="l-tbl">
				<col width="20%">
				<col width="60%">

				<TR>
					<TH class="l-cellsec">�Ж�</TH>
					<TD class="l-cellodd"><input type="text" name=company
						value=""
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">�c�Ƃ��S����</TH>
					<TD class="l-cellodd"><input type="text" name=manager
						value=""
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">���[���A�h���X</TH>
					<TD class="l-cellodd"><input type="text" name=email
						value=""
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">��</TH>
					<TD class="l-cellodd"><input type="text" name="zip_code"
						value=""
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">����</TH>
					<TD class="l-cellodd"><input type="text" name="position"
						value=""
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">�Z��</TH>
					<TD class="l-cellodd"><input type="text" name="address"
						value=""
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">�d�b</TH>
					<TD class="l-cellodd"><input type="text" name="tel"
						value=""
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">�g�ѓd�b</TH>
					<TD class="l-cellodd"><input type="text" name="mobile"
						value=""
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">���M����</TH>
					<TD class="l-cellodd"><input type="text" name="post_result"
						value=""
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">���l��</TH>
					<TD class="l-cellodd"><input type="text" name="other"
						value=""
						style="width: 600" /><br />
					</TD>

				</TR>


				<BR>
				<input type="submit" name="saveWish" value="�ۑ�" class="m-btn" />
				<input type="hidden" name="delete" value="0" />
				<input type="hidden" name="edit" value="1" />

				<input type="submit" value="�߂�" formaction="./autoPostList.php"
					class="m-btn">
				</div>
				</form>

</body>
</html>

