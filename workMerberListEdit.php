<!-------------------------------------------------------------2015/02/06�V�K------------------------------------->
<?php

session_start ();
if (! isset ( $_SESSION ["user_id"] )) {
	header ( "Location: error.php" );
}
?>

<?php


if ($_POST["edit"]){
	 $result=false;
	if(isset($_POST ["saveWish"])){

 $number=$_POST["number"];
 $project_No=$_POST["project_No"];
 $merber_name=$_POST["merber_name"];
 $department=$_POST["department"];
 $position=$_POST["position"];
 $client=$_POST["client"];
 $leader=$_POST["leader"];
 $responsible_officer=$_POST["responsible_officer"];
 $pedriod_time=$_POST["pedriod_time"];
 $EMAIL=$_POST["EMAIL"];
 $department_relations=$_POST["department_relations"];
 $department_company_officer=$_POST["department_company_officer"];
 $officer_MA=$_POST["officer_MA"];
 $money=$_POST["money"];
 $work_overtime=$_POST["work_overtime"];
 $overtime_pay=$_POST["overtime_pay"];
 $deduct=$_POST["deduct"];
 $payment=$_POST["payment"];
 $other=$_POST["other"];


 // DB�֐ڑ�
 include_once './Includes/DBconnect.php';
 $db = DBconnect ();

 mysql_set_charset ( 'sjis' );


  $usersql = "UPDATE merberlist SET project_No = '".$project_No."',merber_name='".$merber_name.
 "', department ='".$department."',position='".$position."',client='".$client."',leader='".$leader.
 "',responsible_officer='".$responsible_officer."',pedriod_time='".$pedriod_time."',EMAIL='".$EMAIL.
 "',department_relations='".$department_relations."',department_company_officer='".$department_company_officer.
 "',officer_MA='".$officer_MA."',money='".$money."',work_overtime='".$work_overtime."',overtime_pay='".$overtime_pay.
 "',deduct='".$deduct."',payment='".$payment."',other='".$other."'where nember='".$number."'";

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
			<span style="color: gray">�ғ��v�����ύX</span>
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

	<form name="workEditWish" action="workMerberListEdit.php" method="POST">
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
					<TH class="l-cellsec">�v���W�F�N�g�ԍ�</TH>
					<TD class="l-cellodd"><input type="text" name="project_No"
						value="<?php echo $_POST ["project_No"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">����</TH>
					<TD class="l-cellodd"><input type="text" name="merber_name"
						value="<?php echo $_POST ["merber_name"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">����</TH>
					<TD class="l-cellodd"><input type="text" name=department
						value="<?php echo $_POST ["department"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">������</TH>
					<TD class="l-cellodd"><input type="text" name="position"
						value="<?php echo $_POST ["position"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">�����</TH>
					<TD class="l-cellodd"><input type="text" name="client"
						value="<?php echo $_POST ["client"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">���[�_�[</TH>
					<TD class="l-cellodd"><input type="text" name="leader"
						value="<?php echo $_POST ["leader"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">�����S����</TH>
					<TD class="l-cellodd"><input type="text" name="responsible_officer"
						value="<?php echo $_POST ["responsible_officer"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">�_�����</TH>
					<TD class="l-cellodd"><input type="text" name="pedriod_time"
						value="<?php echo $_POST ["pedriod_time"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">�����S����Email</TH>
					<TD class="l-cellodd"><input type="text" name="EMAIL"
						value="<?php echo $_POST ["EMAIL"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">�����i�����֌W�j</TH>
					<TD class="l-cellodd"><input type="text" name="department_relations"
						value="<?php echo $_POST ["department_relations"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">������ВS����</TH>
					<TD class="l-cellodd"><input type="text" name="department_company_officer"
						value="<?php echo $_POST ["department_company_officer"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>

				<TR>
					<TH class="l-cellsec">������ВS����Email</TH>
					<TD class="l-cellodd"><input type="text" name="officer_MA"
						value="<?php echo $_POST ["officer_MA"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">�������z</TH>
					<TD class="l-cellodd"><input type="text" name="money"
						value="<?php echo $_POST ["money"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>

				<TR>
					<TH class="l-cellsec">�c�Ɖ���/���</TH>
					<TD class="l-cellodd"><input type="text" name="work_overtime"
						value="<?php echo $_POST ["work_overtime"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">�c�ƒP��</TH>
					<TD class="l-cellodd"><input type="text" name="overtime_pay"
						value="<?php echo $_POST ["overtime_pay"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>

				<TR>
					<TH class="l-cellsec">�T���P��</TH>
					<TD class="l-cellodd"><input type="text" name="deduct"
						value="<?php echo $_POST ["deduct"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">���̑����Z</TH>
					<TD class="l-cellodd"><input type="text" name="payment"
						value="<?php echo $_POST ["payment"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">���l</TH>
					<TD class="l-cellodd"><input type="text" name="other"
						value="<?php echo $_POST ["other"];?>"
						style="width: 600" /><br />
					</TD>

				</TR>

	<!-- ------------------------------------------------------------------------------------------------------------------- -->
			</table>

			<BR> <input type="submit" name="saveWish" value="�ۑ�" class="m-btn" />
			<input type="hidden"name="delete" value="0" />

			<input type="submit" value="�߂�"formaction="./workMerberlist.php?delete=0" class="m-btn" >
		</div>
		
		<?php

	if(isset($_POST ["saveWish"])&&$result){
		?>
		<div>
		<span class="txt-attention"><BR>�ۑ����܂����B	</span>
		</div>
	<?php	
	}else if((isset($_POST ["saveWish"])||$result)){
		?>
		
		<span class="txt-attention"><BR>�\���󂲂����܂���A�ۑ��ł��܂���ł����B</span>
<?php
	}
	}
?>
	</form>
</body>
</html>

