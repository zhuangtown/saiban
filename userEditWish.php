<?php
session_start();
mb_language("Japanese");
if(!isset($_SESSION["user_id"])){
	header("Location: error.php");
}
include_once './Includes/DBconnect.php';
//DB�֐ڑ�
$db=DBconnect();
mysql_set_charset('sjis');
/** Initialize $wishDescriptionIsEmpty */
$wishDescriptionIsEmpty = false;
$noUniqueCode = false;//20120416�ɒǉ�
$rollBack = false;//20120416�ɒǉ�
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//�߂�̃`�F�b�N
	if (array_key_exists("back", $_POST)) {
		header('Location: userMainten.php');
		exit;
	}
	else if(isset($_POST['saveWish'])){
        /*20120416�ɒǉ�start*/
        //�X�V���R�[�h�̕ύX�͂Ȃ��ꍇ�݂̂Ń��j�[�N�`�F�b�N
        if (!(!empty($_POST['wishID']) && ($_POST['wishID'] == $_POST['code']))) {
            //���j�[�N�R�[�h�o���f�[�V����
            $unique_code = mb_convert_encoding($_POST['code'], "SJIS", "auto");
            $sql_uniqueCode_count = "select count(*) from user_master where code = '" . $unique_code . "'";
            $res_uniqueCode_count = mysql_query($sql_uniqueCode_count, $db) or die("DB putout error4");
            $row_uniqueCode_count = mysql_fetch_array($res_uniqueCode_count);
            $uniqueCode_count = $row_uniqueCode_count['count(*)'];
        }
        
        if($uniqueCode_count > 0){
            $noUniqueCode = true;/*end20120416�ɒǉ�*/
        }else if ($_POST['user'] == "") {
			$wishDescriptionIsEmpty = true;
		//}else if ($_POST['wishID'] == "") {
        }else if ($_POST['wishID'] != $_POST['code']) {//20120416�ɒǉ�
			//insert
			$insert_code=mb_convert_encoding($_POST['code'], "SJIS", "auto");
			$insert_user=mb_convert_encoding($_POST['user'], "SJIS", "auto");
			$insert_pswd=mb_convert_encoding($_POST['pswd'], "SJIS", "auto");
			$insert_saiban=mb_convert_encoding($_POST['saiban'], "SJIS", "auto");
			$insert_deparment=mb_convert_encoding($_POST['deparment'], "SJIS", "auto");
			$insert_customer=mb_convert_encoding($_POST['customer'], "SJIS", "auto");
			$insert_doctype=mb_convert_encoding($_POST['doctype'], "SJIS", "auto");
			$insert_usermaster=mb_convert_encoding($_POST['usermaster'], "SJIS", "auto");
			$insert_system=mb_convert_encoding($_POST['system'], "SJIS", "auto");
			$sql_user_master="BEGIN";//20120416�ɒǉ�
            $res_user_master = mysql_query($sql_user_master, $db) or die("DB putout error3");//20120416�ɒǉ�
			$sql_user_master="INSERT INTO user_master (code,user_id,password,saiban,deparment,customer,doctype,usermaster,system) VALUES ('".$insert_code."', '".$insert_user."','".$insert_pswd."','".$insert_saiban."','".$insert_deparment."','".$insert_customer."','".$insert_doctype."','".$insert_usermaster."','".$insert_system."')";
			$res_user_master = mysql_query($sql_user_master, $db) or die("DB putout error2");
            /*20120416�ɒǉ�start*/
            if(!empty($_POST['wishID'])){
                $sql_user_master = "DELETE FROM user_master WHERE code = '".$_POST['wishID']."'";
                $res_user_master = mysql_query($sql_user_master, $db) or die("DB putout error1");
                if(!$res_user_master){
                    $sql_user_master="ROLLBACK";
                    $res_user_master = mysql_query($sql_user_master, $db) or die("DB putout error1");
                    $rollBack = true;
                }else{
                    $sql_user_master="COMMIT";
                    $res_user_master = mysql_query($sql_user_master, $db) or die("DB putout error1");
                }
            }else{
                $sql_user_master="COMMIT";
                $res_user_master = mysql_query($sql_user_master, $db) or die("DB putout error1");
            }
            /*end20120416�ɒǉ�*/
			header('Location: userMainten.php');
			exit;
			//update
		} else if ($_POST['user'] != "") {
			$wishID=mb_convert_encoding($_POST['code'], "SJIS", "auto");
			$upuser=mb_convert_encoding($_POST['user'], "SJIS", "auto");
			$uppswd=mb_convert_encoding($_POST['pswd'], "SJIS", "auto");
			$upsaiban=mb_convert_encoding($_POST['saiban'], "SJIS", "auto");
			$updeparment=mb_convert_encoding($_POST['deparment'], "SJIS", "auto");
			$upcustomer=mb_convert_encoding($_POST['customer'], "SJIS", "auto");
			$updoctype=mb_convert_encoding($_POST['doctype'], "SJIS", "auto");
			$upusermaster=mb_convert_encoding($_POST['usermaster'], "SJIS", "auto");
			$upsystem=mb_convert_encoding($_POST['system'], "SJIS", "auto");
			
			//<!2014-10-22------------------------------------------------------------------------->
			$sql_user_master = "UPDATE user_master SET user_id = '".$upuser."',password='".$uppswd."', code ='".$wishID."',saiban='".$upsaiban."',deparment='".$updeparment."',customer='".$upcustomer."',doctype='".$updoctype."',usermaster='".$upusermaster."',system='".$upsystem."'";
			$res_user_master = mysql_query($sql_user_master, $db) or die("DB putout error2");
			header('Location: user_masterMainten.php');
			exit;
		}
	}
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
					<TD ALIGN="left" HEIGHT="35" WIDTH="15%"></TD>
				</TR>
			</TABLE>
		</div>
	</div>

	<div class="list">
		<h3 align="center">
			<span style="color: gray">���[�U�[�}�X�^</span>
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

	if ($_SERVER['REQUEST_METHOD'] == "POST"){
		
        $wish = array("code" => $_POST['wishID'],"user_id" => $_POST['user'],"password" => $_POST['pswd'],"saiban"=>$_POST['saiban'],"deparment"=>$_POST['deparment'],"customer"=>$_POST['customer'],"doctype"=>$_POST['doctype'],"usermaster"=>$_POST['usermaster'],"system"=>$_POST['system']);//20120416�ɒǉ�
        
	}
	//�C������ꍇ
	else if (array_key_exists("wishID", $_GET)) {
		//$sql = "SELECT name FROM customer where code='".$_GET['wishID']."'";
        $sql = "SELECT code,user_id,password,saiban,deparment,customer,doctype,usermaster,system FROM user_master where code='".$_GET['wishID']."'";//20120416�ɒǉ�
		$res = mysql_query($sql, $db) or die("DB putout error3");
		$row_res=mysql_fetch_array($res);
		$user=$row_res[1];
		$pswd=$row_res[2];
		$saiban=$row_res[3];
		$deparment=$row_res[4];
		$customer=$row_res[5];
		$doctype=$row_res[6];
		$usermaster=$row_res[7];
		$system=$row_res[8];
		//------------------------------------------------------------------------------------------------------------------------------------
        $wish = array("code" => $row_res[1], "user_id" => $row_res[0],"password" => $row_res[2],"saiban" => $row_res[3],"deparment" => $row_res[4],"customer" => $row_res[5],"doctype" => $row_res[6],"usermaster" => $row_res[7],"system" => $row_res[8],);//20120416�ɒǉ�
	   //---------------------------------------------------------------------------------------------------------------------------------------------
	
	}
	
	else
	$wish = array("code" => "", "user_id" => "");
	?>
	<form name="userEditWish" action="userEditWish.php"
		method="POST">
		<div class="list">
			<table class="l-tbl">
				<col width="20%">
				<col width="60%">

				<TR>
					<TH class="l-cellsec">NO.</TH>
					<TD class="l-cellodd"><input type="hidden" name="wishID"
						value="<?php echo $wish['code']; ?>" /> <input type="text"
						name="code"
						value="<?php 
				if(isset($_POST['code'])){
					echo $_POST['code'];
				}
				else if(array_key_exists("wishID", $_GET)){
					echo $_GET['wishID'];
				}
				else{
					//�V�K�ǉ��̏ꍇ�Acode�̔Ԍv�Z	
					$index=1;	
					$sql_maxCount="select count(*) from user_master"; //�����R�[�h��
					$res_maxCount = mysql_query($sql_maxCount, $db) or die("DB putout error4");
					$row_maxCount = mysql_fetch_array($res_maxCount);
										
					$sql_kakunin = "SELECT code FROM user_master order by code";
					$res_kakunin = mysql_query($sql_kakunin, $db) or die("DB putout error5");
					
					if($row_kakunin = mysql_fetch_array($res_kakunin)){
				
						do
						{
							$no_count=intval($row_kakunin[0]);
							if($index<>$no_count){
								if($index<10){
									$index=sprintf("00%s",$index);
								}elseif($index>=10 & $index<=99){
									$index=sprintf("0%s",$index);
								}elseif($index>=100 & $index<=999){
									$index=sprintf("%s",$index);
								}
								$saiban_res=mb_convert_encoding($index, "SJIS", "auto");
								break;
							}
							else{		
								if($index==$row_maxCount[0]){
									$index=$index+1;
									if($index<10){
										$index=sprintf("00%s",$index);
									}elseif($index>=10 & $index<=99){
										$index=sprintf("0%s",$index);
									}elseif($index>=100 & $index<=999){
										$index=sprintf("%s",$index);
									}
									$saiban_res=mb_convert_encoding($index, "SJIS", "auto");
								}				
							}
							$index++;
						}while($row_kakunin = mysql_fetch_array($res_kakunin));	
					}
					else{
						$saiban_res=mb_convert_encoding("001", "SJIS", "auto");					
					}
					echo $saiban_res;
				}
					?>"
						/*readonly=true*/
						style="background: transparent; border-width: 0px; width: 600" maxlength="3">
					</TD>
				</TR>
				<TR>
					<TH class="l-cellsec">���[�U�[��</TH>
					<TD class="l-cellodd"><input type="text" name="user"
						value="<?php 
				if(isset($_POST['user'])){
					echo $_POST['user'];
				}
				else if(array_key_exists("wishID", $_GET)){
					echo $user;
				}
						
						?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<!--!------------------------------------------------------------------------------------->
				<TR>
					<TH class="l-cellsec">�p�X���[�h</TH>
					<TD class="l-cellodd"><input type="text" name="pswd"
						value="<?php 
				if(isset($_POST['pswd'])){
					echo $_POST['pswd'];
				}
				else if(array_key_exists("wishID", $_GET)){
					echo $pswd;
				}
						
						?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				
				<TR>
					<TH class="l-cellsec">�󔭒����ލ쐬</TH>
					<TD class="l-cellodd"><input type="radio" name="saiban"
						value="T" checked="checked"/>�͂�
						<input type="radio" name="saiban" value="F" />������
			�@�@�@�@�@�@�@</TD>
�@�@�@�@�@�@�@�@�@�@�@�@�@�@</TR>
�@�@�@�@�@�@�@�@�@�@�@�@�@�@<TR>
					<TH class="l-cellsec">���ƕ��}�X�^�[</TH>
					<TD class="l-cellodd"><input type="radio" name="deparment"
						value="T" checked="checked"/>�͂�
						<input type="radio" name="deparment" value="F" />������
			�@�@�@�@�@�@�@</TD>
�@�@�@�@�@�@�@�@�@�@�@�@�@�@</TR>
�@�@�@�@�@�@�@�@�@�@�@�@�@�@<TR>
					<TH class="l-cellsec">�����}�X�^�[</TH>
					<TD class="l-cellodd"><input type="radio" name="customer"
						value="T" checked="checked"/>�͂�
						<input type="radio" name="customer" value="F" />������
			�@�@�@�@�@�@�@</TD>
�@�@�@�@�@�@�@�@�@�@�@�@�@�@</TR>
�@�@�@�@�@�@�@�@�@�@�@�@�@�@<TR>
					<TH class="l-cellsec">�������ވꗗ</TH>
					<TD class="l-cellodd"><input type="radio" name="doctype"
						value="T" checked="checked"/>�͂�
						<input type="radio" name="doctype" value="F" />������
			�@�@�@�@�@�@�@</TD>
�@�@�@�@�@�@�@�@�@�@�@�@�@�@</TR>
�@�@�@�@�@�@�@�@�@�@�@�@�@�@<TR>
					<TH class="l-cellsec">���[�U�[�}�X�^�[</TH>
					<TD class="l-cellodd"><input type="radio" name="usermaster"
						value="T" checked="checked"/>�͂�
						<input type="radio" name="usermaster" value="F" />������
			�@�@�@�@�@�@�@</TD>
�@�@�@�@�@�@�@�@�@�@�@�@�@�@</TR>
�@�@�@�@�@�@�@�@�@�@�@�@�@�@�@<TR>
					<TH class="l-cellsec">�V�X�e���ݒ�</TH>
					<TD class="l-cellodd"><input type="radio" name="system"
						value="T" checked="checked"/>�͂�
						<input type="radio" name="system" value="F" />������
			�@�@�@�@�@�@�@</TD>
�@�@�@�@�@�@�@�@�@�@�@�@�@�@</TR>
	<!-- ------------------------------------------------------------------------------------------------------------------- -->		
			</table>
			<?php
			//if ($wishDescriptionIsEmpty){
				?>
			<!--  <span class="txt-attention">����於�����Ă�������<br /> </span> -->
			<?php
			// }
            /*20120416�ɒǉ�start*/
           // if ($noUniqueCode){
            ?>
            <!-- <span class="txt-attention">�B��̎����R�[�h����͂��Ă�������<br /> </span>-->
            <?php
           // }
           /*if ($rollBack){*/
            ?>
           <!--  <span class="txt-attention">���R�[�h�̍X�V�͎��s�ł����B������x�萔�������Ă��ۑ���������<br /> </span> --> 
            <?php
       
			?>
			<BR> <input type="submit" name="saveWish" value="�ۑ�" class="m-btn" />
			<input type="submit" name="back" value="�߂�" class="m-btn" />
		</div>
	</form>
</body>
</html>

