<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
session_start();
mb_language("Japanese");
if(!isset($_SESSION["user_id"])){
    header("Location: Login.php");
}
if(isset($_POST['save'])){
    include("./Includes/accountcheck.php");
    $errorMsgs = validate();
	echo "<span style='color:red'>$errorMsgs</span>";
    //�o���f�[�V������ʂ�ꍇ�A�m�F��ʂ�
    if($errorMsgs == ""){
        require('accounteditsave.php');
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
if (!($explanation = file_get_contents("./files/explanation.txt"))) {
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
function keisan(i){
// �ݒ�J�n

<?php for($i=1;$i<=10;$i++){ ?>
<?php echo "time".$i?>=Number(document.getElementById("<?php echo 'wk_'.$i.'_time'?>").value);
<?php echo "unitprice".$i?>=Number(document.getElementById("<?php echo 'wk_'.$i.'_unitPrice'?>").value);
<?php echo "addtime".$i?>=Number(document.getElementById("<?php echo 'wk_'.$i.'_addtime'?>").value);
<?php echo "subtracttime".$i?>=Number(document.getElementById("<?php echo 'wk_'.$i.'_subtracttime'?>").value);
if(<?php echo "unitprice".$i?>!="" && <?php echo "addtime".$i?>!="" && <?php echo "subtracttime".$i?>!=""){
		 add=(Math.floor((<?php echo "unitprice".$i?>/<?php echo "addtime".$i?>)/10))*10;
		 document.getElementById("<?php echo 'wk_'.$i.'_addunitprice'?>").value=add;
		 sub=(Math.ceil((<?php echo "unitprice".$i?>/<?php echo "subtracttime".$i?>)/10))*10;
		 document.getElementById("<?php echo 'wk_'.$i.'_subtractunitprice'?>").value=sub;
}
<?php } ?>
}

function askeisan(i){
// �ݒ�J�n
<?php for($i=1;$i<=10;$i++){ ?>
<?php echo "time".$i?>=Number(document.getElementById("<?php echo 'wk_'.$i.'_time'?>").value);
<?php echo "unitprice".$i?>=Number(document.getElementById("<?php echo 'wk_'.$i.'_unitPrice'?>").value);
<?php echo "addtime".$i?>=Number(document.getElementById("<?php echo 'wk_'.$i.'_addtime'?>").value);
<?php echo "subtracttime".$i?>=Number(document.getElementById("<?php echo 'wk_'.$i.'_subtracttime'?>").value);
<?php echo "addunitprice".$i?>=Number(document.getElementById("<?php echo 'wk_'.$i.'_addunitprice'?>").value);
<?php echo "subtractunitprice".$i?>=Number(document.getElementById("<?php echo 'wk_'.$i.'_subtractunitprice'?>").value);
if(<?php echo "time".$i?>!=""){
	if(<?php echo "time".$i?>><?php echo "addtime".$i?>){
	if(<?php echo "addunitprice".$i?>!=""){
		 document.getElementById("<?php echo 'wk_'.$i.'_addprice'?>").value=(<?php echo "time".$i?>-<?php echo "addtime".$i?>)*<?php echo "addunitprice".$i?>;
}	
}
	else if(<?php echo "time".$i?><<?php echo "subtracttime".$i?>){
	if(<?php echo "subtractunitprice".$i?>!=""){
		 document.getElementById("<?php echo 'wk_'.$i.'_addprice'?>").value=(<?php echo "time".$i?>-<?php echo "subtracttime".$i?>)*<?php echo "subtractunitprice".$i?>;
}
}}
<?php } ?>
}

function time(){
// �ݒ�J�n
<?php for($i=1;$i<=10;$i++){ ?>
<?php echo "time".$i?>=Number(document.getElementById("<?php echo 'wk_'.$i.'_time'?>").value);
<?php echo "unitprice".$i?>=Number(document.getElementById("<?php echo 'wk_'.$i.'_unitPrice'?>").value);
<?php echo "addtime".$i?>=Number(document.getElementById("<?php echo 'wk_'.$i.'_addtime'?>").value);
<?php echo "subtracttime".$i?>=Number(document.getElementById("<?php echo 'wk_'.$i.'_subtracttime'?>").value);
<?php echo "addunitprice".$i?>=Number(document.getElementById("<?php echo 'wk_'.$i.'_addunitprice'?>").value);
<?php echo "subtractunitprice".$i?>=Number(document.getElementById("<?php echo 'wk_'.$i.'_subtractunitprice'?>").value);
if(<?php echo "time".$i?>!=""){
	if(<?php echo "time".$i?>><?php echo "addtime".$i?>){
	if(<?php echo "addunitprice".$i?>!=""){
		 document.getElementById("<?php echo 'wk_'.$i.'_addprice'?>").value=(<?php echo "time".$i?>-<?php echo "addtime".$i?>)*<?php echo "addunitprice".$i?>;
}	
}
	else if(<?php echo "time".$i?><<?php echo "subtracttime".$i?>){
	if(<?php echo "subtractunitprice".$i?>!=""){
		 document.getElementById("<?php echo 'wk_'.$i.'_addprice'?>").value=(<?php echo "time".$i?>-<?php echo "subtracttime".$i?>)*<?php echo "subtractunitprice".$i?>;
}
}}
<?php } ?>
}

function summoney(){


var sumprice=0;
var shz=0;
var trance=0;
var sumpricez=0;

<?php for($i=1;$i<=10;$i++){ ?>
<?php echo "time".$i?>=Number(document.getElementById("<?php echo 'wk_'.$i.'_time'?>").value);
<?php echo "unitprice".$i?>=Number(document.getElementById("<?php echo 'wk_'.$i.'_unitPrice'?>").value);
<?php echo "addtime".$i?>=Number(document.getElementById("<?php echo 'wk_'.$i.'_addtime'?>").value);
<?php echo "subtracttime".$i?>=Number(document.getElementById("<?php echo 'wk_'.$i.'_subtracttime'?>").value);
<?php echo "addunitprice".$i?>=Number(document.getElementById("<?php echo 'wk_'.$i.'_addunitprice'?>").value);
<?php echo "subtractunitprice".$i?>=Number(document.getElementById("<?php echo 'wk_'.$i.'_subtractunitprice'?>").value);

<?php echo "sumprice".$i?>=Number(document.getElementById("<?php echo 'wk_'.$i.'_unitPrice'?>").value)+Number(document.getElementById("<?php echo 'wk_'.$i.'_addprice'?>").value);
<?php echo "trance".$i?>=Number(document.getElementById("<?php echo 'wk_'.$i.'_trance'?>").value);
sumprice=sumprice+<?php echo "sumprice".$i?>;
trance=trance+<?php echo "trance".$i?>;
if(<?php echo "time".$i?>!=""){
	if(<?php echo "time".$i?>><?php echo "addtime".$i?>){
	if(<?php echo "addunitprice".$i?>!=""){
		 document.getElementById("<?php echo 'wk_'.$i.'_addprice'?>").value=(<?php echo "time".$i?>-<?php echo "addtime".$i?>)*<?php echo "addunitprice".$i?>;
}	
}
	else if(<?php echo "time".$i?><<?php echo "subtracttime".$i?>){
	if(<?php echo "subtractunitprice".$i?>!=""){
		 document.getElementById("<?php echo 'wk_'.$i.'_addprice'?>").value=(<?php echo "time".$i?>-<?php echo "subtracttime".$i?>)*<?php echo "subtractunitprice".$i?>;
}
}}
<?php } ?>
shz=sumprice*0.08;
document.getElementById("sumprice").value=sumprice;
document.getElementById("shz").value=shz;
document.getElementById("trance").value=trance;
document.getElementById("sumpricez").value=sumprice+shz+trance;
}
</script> 
 

<title>�� �� ��</title>
</head>

<body>

<form action=accountedit.php method=post name="order">
<table width="849" border="0">
  <tr>
    <td width="843"><table width="693" border="0">
      <tr>
        <td width="432" align="center" style="font-family:'�l�r ����'; font-size:36px"><div style="font-weight:900"> �� �� ��</div></td>
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
���L�̒ʂ萿���v���܂��B</div></td>
    <td width="449"><table width="437" height="131"  border="1" cellspacing="0">
      <tr>
        <td height="25" colspan="2" bgcolor="#CDE3F3"><div style="font-family:'�l�r �S�V�b�N'; font-size:14px">�����</div></td>
        </tr>
      <tr>
        <td width="301" height="98"   ><table style="font-size:10px;border:0;">
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
      <td height="25px" width="101" bgcolor="#CDE3F3"  align="center" >������No.</td>
      <td height="25px" width="734"  ><?php if(isset($_POST['saibanRes'])){echo $_POST['saibanRes'];}else{echo $_GET['saiban_res'];}?>
	   <input type="hidden" name="saibanRes" value="<?php if(isset($_POST['saibanRes'])){echo $_POST['saibanRes'];}else{echo $_GET['saiban_res'];}?>"   >
	  </td>
    </tr>
    <tr>
      <td height="25px" bgcolor="#CDE3F3" align="center" >�Ɩ�����</td>
      <td height="25px" ><input type="text" name="workName" id="workName"  onblur="onblurs() style="width: 300" maxlength="225" value=""></td>
    </tr>
    <tr>
      <td height="25px" bgcolor="#CDE3F3" align="center" >��Ɠ��e</td>
      <td height="25px"><input type="text" name="workContents" value="" style="width: 300" maxlength="225" onBlur="this.form.wk_1_stepContents.value=this.form.workContents.value;">
	  </td>
    </tr>
    <tr>
      <td height="25px" bgcolor="#CDE3F3"  align="center">��&#12288;&#12288;��</td>
      <td height="25px" >
	  <input type="text" name="periodStart" value="" style="width: 95">
	  <input type="button" onClick="wrtCalendar(event,this.form.periodStart,'yyyy/mm/dd');" style="background-image: url("img/calendar.png"); background-color:#5483B6; color: #ffffff; width:35px; height:20px; border:0; cursor:pointer;" value="�J�n" name="Calendar">
       �`
	  <input type="text" name="periodEnd" value="" style="width: 95">
	  <input type="button" onClick="wrtCalendar(event,this.form.periodEnd,'yyyy/mm/dd');" style="background-image: url("img/calendar.png"); background-color:#5483B6; color: #ffffff; width:35px; height:20px; border:0; cursor:pointer;" value="�I��" name="Calendar">
      </TD>
	</tr>
    <tr>
      <td height="25px" bgcolor="#CDE3F3"  align="center" >�x������</td>
      <td height="25px" ><input type="text" name="payCondition" value="<?php if(isset($_POST['payCondition'])){echo $_POST['payCondition'];}else{echo $payCondition;}?>" style="width: 300" maxlength="225"></td>
    </tr>
    <tr>
      <td height="25px" bgcolor="#CDE3F3" align="center">��Əꏊ</td>
      <td height="25px"><input type="text" name="workPlace" value="" style="width: 300" maxlength="225"></td>
    </tr>
    <tr>
      <td height="25px" bgcolor="#CDE3F3" align="center" >��ƒS��</td>
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
  <COL width="23%">
  <COL width="9%">
  <COL width="9%">
  <COL width="9%">
  <COL width="9%">
  <COL width="9%">
  <col width="9%">
  <col width="9%">
  <col width="9%">
  <TBODY>
  <TR>
    <TD height="25px" bgcolor="#CDE3F3" align="center" >No.</TD>
    <TD height="25px" bgcolor="#CDE3F3"  align="center" >��Ɠ��e</TD>
  <TD height="25px" bgcolor="#CDE3F3"  align="center" >����<br>
      ���ԉ���</TD>
    <TD height="25px" bgcolor="#CDE3F3" align="center" >����<br>
���ԏ��</TD>
   <TD height="25px" bgcolor="#CDE3F3"  align="center" >��P��</TD>
	<TD height="25px" bgcolor="#CDE3F3"  align="center" >���ߒP��</TD>
  <TD height="25px" bgcolor="#CDE3F3"  align="center" >�T���P��</TD>
    <TD height="25px" bgcolor="#CDE3F3"  align="center">���ۉғ�<br>
����</TD>
    <TD height="25px" bgcolor="#CDE3F3"  align="center" >���ߍT��</TD>
    <TD height="25px" bgcolor="#CDE3F3"  align="center" >��ʔ�</TD>

	</TR>


  
 <?php 
            for($i=1;$i<=10;$i++){
          
            
            ?>
            <TR>
                <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_id" value="<?php if(isset($_POST['wk_'.$i.'_id'])){echo $_POST['wk_'.$i.'_id'];}else{echo $i;}?>" readonly=true style="background: transparent; border-width: 0px; width: 100% ;text-align: center;">
                </TD>
                <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_stepContents" value="<?php if(isset($_POST['wk_'.$i.'_stepContents'])){echo $_POST['wk_'.$i.'_stepContents'];}?>" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
               <TD class="l-cellodd"><input  type="text" id="wk_<?php echo $i?>_subtracttime"  name="wk_<?php echo $i?>_subtracttime" value="" style="background: transparent; border-width: 0px; width: 100%">
                </TD> 
				<TD class="l-cellodd"><input type="text" id="wk_<?php echo $i?>_addtime" name="wk_<?php echo $i?>_addtime" value="" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
				 <TD class="l-cellodd"><input type="text" id="wk_<?php echo $i?>_unitPrice" name="wk_<?php echo $i?>_unitPrice" value="" onBlur="keisan(<?php echo $i?>)" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
				<TD class="l-cellodd"><input type="text" id="wk_<?php echo $i?>_addunitprice" name="wk_<?php echo $i?>_addunitprice" value="" onBlur="askeisan(<?php echo $i?>)" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
				<TD class="l-cellodd"><input type="text" id="wk_<?php echo $i?>_subtractunitprice" name="wk_<?php echo $i?>_subtractunitprice" value="" onBlur="askeisan(<?php echo $i?>)" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
				<TD class="l-cellodd"><input type="text" id="wk_<?php echo $i?>_time" name="wk_<?php echo $i?>_time" value="" onBlur="time()"  style="background: transparent; border-width: 0px; width: 100%">
                </TD>
               
                <TD class="l-cellodd"><input type="text" id="wk_<?php echo $i?>_addprice" name="wk_<?php echo $i?>_addprice" value=""   style="background: transparent; border-width: 0px; width: 100%">
                </TD>
                 
                
                <TD class="l-cellodd"><input type="text" id="wk_<?php echo $i?>_trance" name="wk_<?php echo $i?>_trance" value="<?php if(isset($_POST['wk_'.$i.'trance'])){echo $_POST['wk_'.$i.'_trance'];}?>" style="background: transparent; border-width: 0px; width: 100%">
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
        <td bgcolor="#CDE3F3" align="center" >��ʔ�</td>
          <td align="right"><input type="text" id="trance" name="trance" value="" readonly=true style="background: transparent; border-width: 0px; width: 100% ;text-align: center;"></td>
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
 <table  border="0" style="font-family:'�l�r �S�V�b�N'; font-size:12px">
   <tr>
     <td>��L���z�����L�̌����ւ��U���肢�܂��B
     </td>
   </tr>
 </table>
 <table width="398" border="0" cellspacing="0" style="font-family:'�l�r �S�V�b�N'; font-size:12px">
   <tr>
     <td width="392"><TABLE width="279" border="1" cellspacing="0" >
   <TBODY>
     <TR>
	    <TD align=left bgcolor="#CDE3F3" class="l-cellcenter style1">��s</TD>
       <TD width="186" align=left class="l-cellcenter">�O��Z�F��s �_�c�x�X</TD>
      </TR>
     <TR>
	 <TD width="77" bgcolor="#CDE3F3"><span class="style1">�����ԍ�</span></TD>
       <TD align=left>(��)12345678</TD>
      </TR>
	 <TR>
	 <TD width="77" height="22" bgcolor="#CDE3F3"><span class="style1">�������`</span></TD>
       <TD align=left>�)����ظ�</TD>
      </TR>
   </TBODY>
 </TABLE></td>
   </tr>
</table>
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
