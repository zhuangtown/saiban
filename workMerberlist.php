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
			<span style="color: darkslategray">�ғ��v���ꗗ</span>
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

	if ($_GET ["delete"]==1) {
     $number=$_GET ["number"];
	 $delete_sql = "DELETE FROM merberlist WHERE nember=$number ";
		 mysql_query ( $delete_sql, $db ) or die ( "DB connect NG!" );
 }

 $usersql = "SELECT `nember`,`project_No`,`merber_name`,`department`,`position`,`client`,`leader`,
		   `responsible_officer`,`pedriod_time`, `EMAIL`,`department_relations`,`department_company_officer`,
			`officer_MA`,`money`,`work_overtime`,`overtime_pay`,`deduct`,`payment`,`other`FROM merberlist ";

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
				<TH class="l-cellcenter">�v���W�F�N�g�ԍ�</TH>
				<TH class="l-cellcenter">����</TH>
				<TH class="l-cellcenter">����</TH>
				<TH class="l-cellcenter">������</TH>
				<TH class="l-cellcenter">�����</TH>
				<TH class="l-cellcenter">���[�_�[</TH>
				<TH class="l-cellcenter">�����S����</TH>
				<TH class="l-cellcenter">�_�����</TH>
				<TH class="l-cellcenter">�����S����Email</TH>
				<TH class="l-cellcenter">�����i�����֌W�j</TH>
				<TH class="l-cellcenter">������ВS����</TH>
				<TH class="l-cellcenter">������ВS����Email</TH>
				<TH class="l-cellcenter">�������z</TH>
				<TH class="l-cellcenter">�c�Ɖ���/���</TH>
				<TH class="l-cellcenter">�c�ƒP��</TH>
				<TH class="l-cellcenter">�T���P��</TH>
				<TH class="l-cellcenter">���̑����Z</TH>
				<TH class="l-cellcenter">���l</TH>
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
								name="workMerberListEdit" action="workMerberListEdit.php"
								method="post">


								 <input
									type="hidden" name="no" value="<?php echo $i; ?>" /> <input
									type="hidden" name="edit" value="1" /> <input type="hidden"
									name="number" value="<?php echo $row["nember"]; ?>" /> <input
									type="hidden" name="project_No"
									value="<?php echo $row["project_No"]; ?>" /> <input
									type="hidden" name="merber_name"
									value="<?php echo $row["merber_name"]; ?>" /> <input
									type="hidden" name="department"
									value="<?php echo $row["department"]; ?>" /> <input
									type="hidden" name="position"
									value="<?php echo $row["position"]; ?>" /> <input type="hidden"
									name="client" value="<?php echo $row["client"]; ?>" /> <input
									type="hidden" name="leader"
									value="<?php echo $row["leader"]; ?>" /> <input type="hidden"
									name="responsible_officer"
									value="<?php echo $row["responsible_officer"]; ?>" /> <input
									type="hidden" name="pedriod_time"
									value="<?php echo $row["pedriod_time"]; ?>" /> <input
									type="hidden" name="EMAIL" value="<?php echo $row["EMAIL"]; ?>" />
								<input type="hidden" name="department_relations"
									value="<?php echo $row["department_relations"]; ?>" /> <input
									type="hidden" name="department_company_officer"
									value="<?php echo $row["department_company_officer"]; ?>" /> <input
									type="hidden" name="officer_MA"
									value="<?php echo $row["officer_MA"]; ?>" /> <input
									type="hidden" name="money" value="<?php echo $row["money"]; ?>" />
								<input type="hidden" name="work_overtime"
									value="<?php echo $row["work_overtime"]; ?>" /> <input
									type="hidden" name="overtime_pay"
									value="<?php echo $row["overtime_pay"]; ?>" /> <input
									type="hidden" name="deduct"
									value="<?php echo $row["deduct"]; ?>" /> <input type="hidden"
									name="payment" value="<?php echo $row["payment"]; ?>" /> <input
									type="hidden" name="other" value="<?php echo $row["other"]; ?>" />

								<input TYPE="submit" name="editWish" VALUE="�ύX" class="i-btn">
							</form>
						</TD>

						<TD>
							<form style='padding: 0px; margin: 0px;' height=0 name=
								"userDeleteWish" action="workMerberlist.php" method="GET">
								<input type="hidden" name="number"value="<?php echo $row["nember"]; ?>" />
								<input type="hidden" name="delete" value="1" />
								
								<input type="hidden" name="saveWish" value="0" />
								
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

		<form name="workMerberListAdd" action="workMerberListAdd.php"
			method="post">
			<input type="hidden" name="edit" value="1" /> <input type="submit"
				value="�ғ��v���ǉ�" class="m-btn" />
		</form>
	</div>
</body>
</html>