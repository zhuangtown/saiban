<!-------------------------------------------------------------2015/02/06新規------------------------------------->
<?php

session_start ();
if (! isset ( $_SESSION ["user_id"] )) {
	header ( "Location: error.php" );
}
?>

<?php


if ($_POST["edit"]){

 $number=$_POST["number"];
 $company=$_POST["company"];
 $manager=$_POST["manager"];
 $email=$_POST["email"];
 $zip_code=$_POST["zip_code"];
 $address=$_POST["address"];
 $tel=$_POST["tel"];
 $mobile=$_POST["mobile"];
 $post_result=$_POST["post_result"];
 $other=$_POST["other"];



 // DBへ接続
 include_once './Includes/DBconnect.php';
 $db = DBconnect ();

 mysql_set_charset ( 'sjis' );


  $usersql = "UPDATE auto_post SET number = '".$number."',company='".$company.
 "', manager ='".$manager."',email='".$email."',zip_code='".$zip_code."',address='".$address.
 "',tel='".$tel."',mobile='".$mobile."',post_result='".$post_result.
 "',other='".$other."'where number='".$number."'";

 $result = mysql_query ( $usersql, $db ) or die ( "DB connect die!" );



}




?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Shift-JIS">
<meta http-equiv="Content-Style-Type" content="text/css">
<link href="css/common.css" rel="stylesheet" type="text/css">
<TITLE>メニュー</TITLE>
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
						VALUE="メニュー" onClick="location.href='Menu.php'" class="i-btn"><INPUT
						TYPE="BUTTON" VALUE="ログアウト" onClick="location.href='Login.php'"
						class="i-btn"></TD>
				</TR>
			</TABLE>
		</div>
	</div>

	<div class="list">
		<h3 align="center">
			<span style="color: gray">自動送信リスト情報変更</span>
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

	<form name="autoPostListEdit" action="<?php $_SERVER["PHP_SELF"] ?>" method="POST">
	<input type="hidden" name="edit"value="1" />
		<div class="list">
			<table class="l-tbl">
				<col width="20%">
				<col width="60%">
				<TR>
                 <input type="hidden" name="number"value="<?php echo $_POST["number"]; ?>" />
                 </TR>

				<TR>
					<TH class="l-cellsec">No.</TH>
					 <TD class="l-cellodd"><input type="hidden" name="no"value="<?php echo $_POST["no"]; ?>" /><?php echo $_POST["no"];?>



					</TD>

				</TR>



				<TR>
					<TH class="l-cellsec">社名</TH>
					<TD class="l-cellodd"><input type="text" name=company
						value="<?php echo $_POST ["company"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">営業ご担当者</TH>
					<TD class="l-cellodd"><input type="text" name=manager
						value="<?php echo $_POST ["manager"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">メールアドレス</TH>
					<TD class="l-cellodd"><input type="text" name=email
						value="<?php echo $_POST ["email"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">〒</TH>
					<TD class="l-cellodd"><input type="text" name="zip_code"
						value="<?php echo $_POST ["zip_code"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">肩書</TH>
					<TD class="l-cellodd"><input type="text" name="position"
						value="<?php echo $_POST ["position"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">住所</TH>
					<TD class="l-cellodd"><input type="text" name="address"
						value="<?php echo $_POST ["address"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">電話</TH>
					<TD class="l-cellodd"><input type="text" name="tel"
						value="<?php echo $_POST ["tel"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">携帯電話</TH>
					<TD class="l-cellodd"><input type="text" name="mobile"
						value="<?php echo $_POST ["mobile"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">送信結果</TH>
					<TD class="l-cellodd"><input type="text" name="post_result"
						value="<?php echo $_POST ["post_result"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">備考欄</TH>
					<TD class="l-cellodd"><input type="text" name="other"
						value="<?php echo $_POST ["other"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>


	<!-- ------------------------------------------------------------------------------------------------------------------- -->
			</table>

			<BR> <input type="submit" name="saveWish" value="保存" class="m-btn" />
			<input type="hidden"name="delete" value="0" />
			<input type="hidden"name="edit" value="1" />

			<input type="submit" value="戻る"formaction="./autoPostList.php" class="m-btn" >
		</div>
	</form>
</body>
</html>

