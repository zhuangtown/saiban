<?php
session_start ();
if (! isset ( $_SESSION ["user_id"] )) {
	header ( "Location: error.php" );
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
					<!--					<TD WIDTH="95%"></TD>------2015/02/06�V�K------------------------------------->
					<TD WIDTH="65%"></TD>
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
			<!--			<span style="color: gray">Customer�}�X�^</span> 2013/03/13���C-->
			<span style="color: darkslategray">������ЃV�����g���N�X�Č���񎩓����M</span>
		</h3>

	</div>


	<BR>
	<BR>
	<BR>
	<?php

	include_once './Includes/DBconnect.php';
	// DB�֐ڑ�
	$db = DBconnect ();
	mysql_set_charset ( 'sjis' );



	if ($_GET ["delete"]=='1') {
     $number=$_GET ["number"];
 $delete_sql = "DELETE  FROM". " auto_post WHERE number=".$number ;
		 mysql_query ( $delete_sql, $db ) or die ( "DB connect NG!" );
 }

    $usersql = "SELECT `number`,`company`,`manager`,`email`,`zip_code`,`position`,`address`,
		   `tel`,`mobile`, `post_result`,`other` FROM auto_post ";

 $result = mysql_query ( $usersql, $db ) or die ( "DB connect NG!" );
	?>

	<div class="list">
		<table class="userl-tbl">
			<col width="5%">
			<col width="15%">
			<col width="15%">
			<col width="15%">

			<TR>
				<TH class="l-cellcenter">No.</TH>
				<TH class="l-cellcenter">�Ж�</TH>
				<TH class="l-cellcenter">�c�Ƃ��S����</TH>
				<TH class="l-cellcenter">���[���A�h���X</TH>
				<TH class="l-cellcenter">��</TH>
				<TH class="l-cellcenter">����</TH>
				<TH class="l-cellcenter">�Z��</TH>
				<TH class="l-cellcenter">�d�b</TH>
				<TH class="l-cellcenter">�g�ѓd�b</TH>
				<TH class="l-cellcenter">���M����</TH>
				<TH class="l-cellcenter">���l��</TH>
				<TH class="l-cellcenter">�ύX�E�폜</TH>


			</TR>
			<?php
			$i = 0;
			while ( $row = mysql_fetch_array ( $result ) ) {
				// $wishID = $row[0];
				$i ++;
				?>
				<tr>
				<TD class="l-cellodd"><input name="no" type="text"
					value="<?php echo $i?>" readonly=true
					style="background: transparent; border-width: 0px; width: 100; font-weight: bold; color: steelblue">
				</TD>
				<?php

				for($j = 1; $j < sizeof ( $row ) / 2; $j ++) {

					?>
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[$j]?>" readonly=true
					style="background: transparent; border-width: 0px; width: 100; font-weight: bold; color: steelblue">

				</TD>

   <?php
				}
				?>
					<TD class="l-cellodd">
					<table class="l-tbl">
						<TD>
							<form style='padding: 0px; margin: 0px;'
								name="autoPostListEdit" action="autoPostListEdit.php"
								method="post">


								 <input
									type="hidden" name="no" value="<?php echo $i; ?>" />
									<input type="hidden" name="edit" value="1" />
									<input type="hidden"name="number" value="<?php echo $row["number"]; ?>" />
									 <input type="hidden" name="company" value="<?php echo $row["company"]; ?>" />
									  <input type="hidden" name="manager"value="<?php echo $row["manager"]; ?>" />
									   <input type="hidden" name="email"value="<?php echo $row["email"]; ?>" />
									   <input type="hidden" name="zip_code" value="<?php echo $row["zip_code"]; ?>" />
									   <input type="hidden" name="position" value="<?php echo $row["position"]; ?>" />
									    <input type="hidden" name="address"value="<?php echo $row["address"]; ?>" />
									     <input type="hidden" name="tel" value="<?php echo $row["tel"]; ?>" />
									      <input type="hidden" name="mobile" value="<?php echo $row["mobile"]; ?>" />
									      <input type="hidden" name="post_result" value="<?php echo $row["post_result"]; ?>" />
									      <input type="hidden" name="other" value="<?php echo $row["other"]; ?>" />


								<input TYPE="submit" name="editWish" VALUE="�ύX" class="i-btn">
							</form>
						</TD>

						<TD>
							<form style='padding: 0px; margin: 0px;' height=0 name=
								"userDeleteWish" action="autoPostList.php" method="GET">
								<input type="hidden" name="number"value="<?php echo $row["number"]; ?>" />
								<input type="hidden" name="delete" value="1" />
								<input TYPE="submit" name="deleteWish" VALUE="�폜" class="i-btn">
							</form>
						</TD>
					</table>
				</TD>

				<?php
				echo "</tr>";
			}
			?>





		</table>

		<form name="autoPostListAdd" action="autooppadd.php"
			method="post">
			<input type="hidden" name="edit" value="0" /> <input type="submit"
				value="�ǉ�" class="m-btn" />
		</form>
	</div>
</body>
</html>