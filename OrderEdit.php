<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
mb_language("Japanese");
if(!isset($_SESSION["user_id"])){
    header("Location: Login.php");
}
if(isset($_POST['save'])){
    include("./Includes/orderscheck.php");
    $errorMsgs = validate();
	echo "<span style='color:red'>$errorMsgs</span>";
    //�o���f�[�V������ʂ�ꍇ�A�m�F��ʂ�
    if($errorMsgs == ""){
        require('orderEditsave.php');
        exit;
    }
}
?>

<?php
 include_once './Includes/DBconnect.php';
//DB�֐ڑ�
$db=DBconnect();
//DB�̑I��
mysql_set_charset('sjis');

//setsys�e�[�v������---------------------------����͉�Ђ̏��֎��ւ�----------------------------------------------------------
    $sql_setsys="SELECT  `name`,`postcode`,`address`,`tel`,`fax` FROM `setsys` WHERE code=1";
    $res_setsys=mysql_query($sql_setsys,$db) or die ("DB putouterror setsys");
    $row_setsys=mysql_fetch_array($res_setsys);
	
	if(isset($_POST['saibanRes']))
	{$rest=substr($_POST["saibanRes"],8,3);}
	else
	{$rest=substr($_GET['saiban_res'],8,3);}
	
	$sql_filema="SELECT `name` FROM `customer` WHERE `code` ='". $rest."'";
	$res_filema=mysql_query($sql_filema, $db) or die ("DB putout error02");
	$row_filema=mysql_result($res_filema,0);
	$tori=$row_filema;
			
	
	//�e�L�X�g�t�@�C������f�[�^��ǂݍ���
$payCondition = "";
$explanation = "";
if (!($payCondition = file_get_contents("./files/payCondition.txt"))) {
    echo "�t�@�C�����J���܂���B";
}
if (!($explanation = file_get_contents("./files/tms/explanation.txt"))) {
    echo "�t�@�C�����J���܂���B";
}
header('Cache-Control:no-cache');
			?>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
<link rel="stylesheet" type="text/css" href="./js/menu/fixedMenu_style1.css" />
<script src="./js/calendar.js" language="JavaScript"></script>
<script type="text/javascript" src="./js/menu/jquery-1.4.2.min.js" language="JavaScript"></script>
<script type="text/javascript" src="./js/menu/jquery.fixedMenu.js" language="JavaScript"></script>
<script type="text/javascript">
function keisan(){
// �ݒ�J�n

<?php for($i=1;$i<=10;$i++){ ?>
<?php echo "Number".$i?>=Number(document.getElementById("<?php echo 'wk_'.$i.'_Number'?>").value);
<?php echo "unitprice".$i?>=Number(document.getElementById("<?php echo 'wk_'.$i.'_unitprice'; ?>").value);
if(<?php echo "unitprice".$i?>!=""){
         price=<?php echo "Number".$i?>*<?php echo "unitprice".$i?>;
		 add=(Math.floor((<?php echo "unitprice".$i?>/200)/10))*10;
		 subtractUnitprice=(Math.ceil((<?php echo "unitprice".$i?>/160)/10))*10;
		 document.getElementById("<?php echo 'wk_'.$i.'_price'?>").value=price;
		 document.getElementById("<?php echo 'wk_'.$i.'_addunitPrice'?>").value=add;
		 document.getElementById("<?php echo 'wk_'.$i.'_subtractunitprice'?>").value=subtractUnitprice;
}	
<?php } ?>
}


function summoney(){
var sumprice=0;
var shz=0;
var sumpricez=0;

<?php for($i=1;$i<=10;$i++){ ?>
sumprice=sumprice+Number(document.getElementById("<?php echo 'wk_'.$i.'_price'?>").value);
<?php } ?>
shz=sumprice*0.08;
document.getElementById("sumprice").value=sumprice;
document.getElementById("shz").value=shz;
document.getElementById("sumpricez").value=sumprice+shz;
}
</script> 
</head>

<body>
<form action=orderedit.php method=post name="order">
<table width="849" border="0">
  <tr>
    <td width="843"><table width="693" border="0">
      <tr>
        <td width="432" align="center" style="font-family:'�l�r ����'; font-size:36px"><div style="font-weight:900"> ���@���@��</div></td>
        <td width="251"><table width="248" border="0" cellspacing="0">
      <tr>
        <td width="98"  style=" font-family:'�l�r �S�V�b�N';font-size:12px">��&#12288;�s&#12288;��:</td>
        <td width="134" style=" font-family:'�l�r �S�V�b�N';font-size:12px"><input type="text" name="buildDate" value="<?php echo  date('Y-m-d',time());?>" onClick="wrtCalendar(event,this.form.buildDate,'yyyy-mm-dd');"></td>
      </tr>
      <tr>
        <td width="98"  style=" font-family:'�l�r �S�V�b�N';font-size:12px">��&#12288;&#12288;&#12288;��:</td>
        <td width="134" style=" font-family:'�l�r �S�V�b�N';font-size:12px"><span><?php if(isset($_POST['saibanRes'])){echo $_POST['saibanRes'];}else{echo $_GET['saiban_res'];}?></span></td>
      </tr>
      
    </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="848" border="0">
  <tr>
    <td width="842">&nbsp;</td>
  </tr>
  <tr>
    <td ><div style="font-family:'�l�r ����'; font-size:18px"><b><u><?php echo $tori ?></div></u></b></td>
  </tr>
  
</table>
<table width="845"  border="0" style="margin: 0">
  <tr>
    <td width="386" height="133"   ><br/>
      <div style="font-family:'�l�r ����'; font-size:12px">&#12288;&#12288;���f�͊i�ʂ̂����z���A�������\���グ�܂��B<br />
���L�̒ʂ蔭���v���܂��B</div></td>
    <td width="449"><table width="437" height="131"  border="1" cellspacing="0">
      <tr>
        <td height="25px"  colspan="2" bgcolor="#CDE3F3"><div style="font-family:'�l�r �S�V�b�N'; font-size:14px">�����</div></td>
        </tr>
      <tr>
        <td width="301" height="98"   ><table style="font-size:12px;border:0;">
          <tr>
            <td  ><?php echo $row_setsys[0]?></td>
          </tr>
          <tr>
            <td><?php echo $row_setsys[1]?></td>
          </tr>
          <tr>
            <td><?php echo $row_setsys[2] ?></td>
          </tr>
          <tr>
            <td>�d�b�ԍ��F<?php echo $row_setsys[3] ?></td>
          </tr>
          <tr>
            <td >�t�@�N�X�F<?php echo $row_setsys[4] ?></td>
          </tr>
        </table></td>
        <td width="120">&nbsp;</td>
      </tr>
      
    </table></td>
  </tr>
</table>
<table width="847" border="1"  cellpadding="0px" bgcolor="#FFFFFF" cellspacing="0px" style="font-family:'�l�r �S�V�b�N'; font-size:12px">
  <colgroup>
  <col width="20%" />
  <col width="60%" />
  </colgroup>
  <tbody >
    <tr>
      <td height="25px"  width="80px" bgcolor="#CDE3F3"  align="center" >������No.</td>
      <td width="734"  ><?php if(isset($_POST['saibanRes'])){echo $_POST['saibanRes'];}else{echo $_GET['saiban_res'];}?>
	  <input type="hidden" name="saibanRes" value="<?php if(isset($_POST['saibanRes'])){echo $_POST['saibanRes'];}else{echo $_GET['saiban_res'];}?>"   >
	  </td>
    </tr>
    <tr>
      <td height="25px"  width="80px" bgcolor="#CDE3F3" align="center" >�Ɩ�����</td>
     <td height="25px" ><input type="text" name="workName" id="workName"  onblur="onblurs() style="width: 300" maxlength="225" value=""></td>
    </tr>
    <tr>
      <td  height="25px"  width="80px" bgcolor="#CDE3F3" align="center" >��Ɠ��e</td>
      <td height="25px"><input type="text" name="workContents" value="" style="width: 300" maxlength="225" onBlur="this.form.wk_1_stepContents.value=this.form.workContents.value;">
	  </td>
    </tr>
    <tr>
      <td  height="25px"  width="80px" bgcolor="#CDE3F3"  align="center">��&#12288;&#12288;��</td>
	   <td height="25px" >
     <input type="text" name="periodStart" value="" style="width: 95">
	  <input type="button" onClick="wrtCalendar(event,this.form.periodStart,'yyyy/mm/dd');" style="background-image: url("img/calendar.png"); background-color:#5483B6; color: #ffffff; width:35px; height:20px; border:0; cursor:pointer;" value="�J�n" name="Calendar">
       �`
	  <input type="text" name="periodEnd" value="" style="width: 95">
	  <input type="button" onClick="wrtCalendar(event,this.form.periodEnd,'yyyy/mm/dd');" style="background-image: url("img/calendar.png"); background-color:#5483B6; color: #ffffff; width:35px; height:20px; border:0; cursor:pointer;" value="�I��" name="Calendar">
      </td>
    </tr>
    <tr>
      <td  height="25px"  width="80px" bgcolor="#CDE3F3"  align="center" >�x������</td>
      <td height="25px" ><input type="text" name="payCondition" value="<?php if(isset($_POST['payCondition'])){echo $_POST['payCondition'];}else{echo $payCondition;}?>" style="width: 300" maxlength="225"></td>
    </tr>
    <tr>
      <td  height="25px"  width="80px" bgcolor="#CDE3F3" align="center">��Əꏊ</td>
       <td height="25px"><input type="text" name="workPlace" value="" style="width: 300" maxlength="225"></td>
    </tr>
    <tr>
      <td  height="25px"  width="80px"  bgcolor="#CDE3F3" align="center" >��ƒS��</td>
       <td ><input type="text" name="workCharge" value="" style="width: 300" maxlength="225"></td>
    </tr>
  </tbody>
</table>
<table width="847" border="0">
  <tr>
    <td width="847" align="right" style="font-family:'�l�r �S�V�b�N'; font-size:9px">���ԒP�ʁFH&#12288;&#12288;���z�P�ʁF�~</td>
  </tr>
</table>
<TABLE width="850" border="1"  cellspacing="0" style="font-family:'�l�r �S�V�b�N'; font-size:12px">
  <COLGROUP>
  <COL width="5%">
  <COL width="35%">
  <COL width="10%">
  <COL width="10%">
  <COL width="10%">
  <COL width="10%">
  <COL width="10%">
  <col width="10%">
  <TBODY>
  <TR>
    <TD height="25px" bgcolor="#CDE3F3" align="center" >No.</TD>
    <TD bgcolor="#CDE3F3"  align="center" >��Ɠ��e</TD>
    <TD bgcolor="#CDE3F3"  align="center" >���ʁi�l���j</TD>
    <TD bgcolor="#CDE3F3" align="center" >�P��</TD>
    <TD bgcolor="#CDE3F3"  align="center">���z</TD>
    <TD bgcolor="#CDE3F3"  align="center" >�ǉ��P��</TD>
    <TD bgcolor="#CDE3F3"  align="center" >�T���P��</TD>
   </TR>
  
<?php 
            for($i=1;$i<=10;$i++){
          
            
            ?>
            <TR>
                <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_id" value="<?php if(isset($_POST['wk_'.$i.'_id'])){echo $_POST['wk_'.$i.'_id'];}else{echo $i;}?>" readonly=true style="background: transparent; border-width: 0px; width: 100% ;text-align: center;">
                </TD>
                <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_stepContents" value="<?php if(isset($_POST['wk_'.$i.'_stepContents'])){echo $_POST['wk_'.$i.'_stepContents'];}?>" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
               <TD class="l-cellodd"><input  type="text" id="wk_<?php echo $i?>_Number"  name="wk_<?php echo $i?>_Number" value="" style="background: transparent; border-width: 0px; width: 100%">
                </TD> 
				<TD class="l-cellodd"><input type="text" id="wk_<?php echo $i?>_unitprice" name="wk_<?php echo $i?>_unitprice" value="" onBlur="keisan()" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
				<TD class="l-cellodd"><input type="text" id="wk_<?php echo $i?>_price" name="wk_<?php echo $i?>_price" value="" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
                <TD class="l-cellodd"><input type="text" id="wk_<?php echo $i?>_addunitPrice" name="wk_<?php echo $i?>_addunitPrice" value=""  style="background: transparent; border-width: 0px; width: 100%">
                </TD>
                <TD class="l-cellodd"><input type="text" id="wk_<?php echo $i?>_subtractunitprice" name="wk_<?php echo $i?>_subtractunitprice" value=""   style="background: transparent; border-width: 0px; width: 100%">
                </TD>
                 
            </TR>
            <?php 
            }
            ?>
       
   </TBODY>
</TABLE>
</div>
</td>
<table width="857" border="0" style="font-family:'�l�r �S�V�b�N'; font-size:12px">
  <tr>
    <td width="581" align="right"><input type="button" name="sum" value="���v" onclick="summoney()"></td>
    <td width="266"><table  width="231" border="1" align="right" cellspacing="0">
      <tr>
        <td width="82" bgcolor="#CDE3F3" align="center" ><span class="style1">���v���z</span></td>
          <td width="133" align="right"><input type="text" id="sumprice" name="sumprice" value="" readonly=true style="background: transparent; border-width: 0px; width: 100% ;text-align: center;"></td>
        </tr>
      <tr>
        <td bgcolor="#CDE3F3"  align="center">�����(8%)</td>
          <td align="right"><input type="text" id="shz" name="shz" value="" readonly=true style="background: transparent; border-width: 0px; width: 100% ;text-align: center;"></td>
        </tr>
      <tr>
        <td bgcolor="#CDE3F3"  align="center">���v���z(�ō�)</td>
          <td align="right"><input type="text" id="sumpricez" name="sumpricez" value="" readonly=true style="background: transparent; border-width: 0px; width: 100% ;text-align: center;"></td>
        </tr>
    </table></td>
  </tr>
</table>
 <table width="210" border="0">
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
   <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
   </tr>
 </table>

 <p>&nbsp;</p>
 
 <DIV class=list>
  <p>&nbsp;</p>
  <TABLE  style="font-family:'�l�r �S�V�b�N'; font-size:12px">
  <TBODY>
    <TR><TD class=l-cellodd>�E�v�F</TD></TR>
    <TR><TD class=l-cellodd><textarea name="explanation" cols=137% rows=10 value=""><?php if(isset($_POST['explanation'])){echo $_POST['explanation'];}else{echo $explanation;}?>
                           </textarea>
	</TD>
	</TR>
	<TR><TD align=center><br><input type="submit" name="save" value="�ۑ�">
         </TD>
    </TR>
  </TBODY>
</TABLE>
</DIV>
</form>

</body>
</html>

