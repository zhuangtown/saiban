<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);//shutdown error wwarining!!
session_start();
if(!isset($_SESSION["user_id"])){
	header("Location: Login.php");
}
$case = "";
if (!($case = file_get_contents("files/case.txt"))) {
    echo "�t�@�C�����J���܂���B";
}
?>


<?php include('menubar.php'); ?>
	<div id="head">
	</div>
	<?php

	include_once './Includes/DBconnect.php';
	//DB�֐ڑ�
	$db=DBconnect();
	mysql_set_charset('sjis');
	$count_sql="SELECT count(*) AS total FROM auto_post";
	$auto_sql="SELECT * FROm auto_post";
	$count = mysql_query($count_sql,$db) or die("DB ERROR!");
	$auto = mysql_query($auto_sql,$db) or die("DB autoERROR!");
	$row_count=mysql_fetch_array($count);

	?>
	<form action=mail.php method=POST>
 <table class="l-tbl">
               
				 <TR>
                <TH class="width: 3px;">No.</TH>
                <TH class="width: 8px;">�Ж�</TH>
                <TH class="width: 5px;">�c�Ƃ��S����</TH>
                <TH class="width: 10px;">���[���A�h���X</TH>
                <TH class="width: 5px;">��</TH>
                <TH class="width: 5px;">����</TH>
                <TH class="width: 15px;">�Z��</TH>
				<TH class="width: 5px;">�d�b</TH>
				<TH class="width: 5px;">�g�ѓd�b</TH>
				<TH class="width: 6px;">���l��</TH>
				<TH class="width: 6px;">���M</TH>
                </TR>
 <?php 
			$i=1;
            while($row_auto=mysql_fetch_array($auto,MYSQL_ASSOC)){
			
             ?>
            <TR>
                <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_id" value="<?php echo $row_auto["number"] ?>" readonly=true style="background: transparent; border-width: 0px; width: 100% ;text-align: center;">
                </TD>
                <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_company" value="<?php echo $row_auto["company"] ?>" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
                <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_manager" value="<?php echo $row_auto["manager"] ?>" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
                <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_email" value="<?php if(isset($row_auto["email"])){echo $row_auto["email"];} ?>" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
                <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_zip_code" value="<?php echo $row_auto["zip_code"] ?>" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
                <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_position" value="<?php echo $row_auto["position"] ?>" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
                 <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_address" value="<?php echo $row_auto["address"] ?>" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
                <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_tel" value="<?php echo $row_auto["tel"] ?>" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
                   <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_mobile" value="<?php echo $row_auto["mobile"] ?>" style="background: transparent; border-width: 0px; width: 100%">
              </TD>
                <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_other" value="<?php echo $row_auto["other"] ?>" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
				<TD class="l-cellodd"><input type="checkbox" name="wk_<?php echo $i?>_check" value="<?php if(isset($row_auto["email"])){echo $row_auto["email"];} ?>" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
            </TR>
            <?php 
			$i++;
            }
            ?>		
				<input type="hidden" name="count" value="<?php echo $i ?>">
            </table>
			<table class="l-tbl" >
			<TR>
			<TD>
			���[������
			</TD>
			<TD>
			�Č����- �V�����g���N�X<?php echo date("ymd");?>
			</TD>
			</TR>
			<TR>
			<TD>
			���[�����e
			</TD>
			<TD>
			���������b�ɂȂ��Ă���܂��B������ЃV�����g���N�X���ł������܂��B
			</TD>
			</TR>
			<TR>
			<TD>
			</TD>
			<TD>
			<table>
			<TR>
			<TD>
			�y�Č����z  �@�F
			</TD>
			<TD>
			<input type="text" name="caseName" value="<?php if(isset($_POST['caseName'])){echo $_POST['caseName'];}?>" style="background: transparent; border-width: 0px; width: 100%">
			</TD>
			</TR>
			</table>
			</TD>
			</TR>
			<TR>
			<TD>
			</TD>
			<TD>
			<table>
			<TR>
			<TD>
			�y�Č��ڍׁz �F
			</TD>
			<TD>
			<textarea name="case" style="background: transparent; border-width: 0px; width: 100%;height:150px"><?php if(isset($_POST['case'])){echo mb_convert_encoding($_POST['case'], "SJIS", "auto");}else{echo mb_convert_encoding($case, "SJIS", "auto");}?></textarea>
			</TD>
			</TR>
			</table>
			</TD>
			</TR>
			<TR>
			<TD>
			
			</TD>
			<TD>
		������낵�����肢�\���グ�܂��B<br>

�y���L�����z<br>
���{�Č���́A�C���^�[�l�b�g��̌��J�A�����}�K���̌f�ځE���Г]�����������������B<br>
������Č�A�������3���c�Ɠ����߂��Ă��A�����Ȃ������ꍇ�́A<br>
������Ƃ����f�������Ƃ��������肢�܂��B<br>

*************************************************************<br>
������ЃV�����g���N�X�@http://www.symmetrix.co.jp<br>
�c�Ƌ��ʃ��[���A�h���X�Fsales@symmetrix.co.jp�@<br>
�@�q��(�`���@�r�����C)            080-3933-7227<br>
�X���@�p�m(�����V�} �q�f�q�g)�@  �@080-3502-2882<br>
���@��(�J�c ���C)                      090-3206-3463<br>

��103-0023<br>
�����s��������{���{��4-4-11 �i��r���V�K<br>
Tel�F03-6225-2882 Fax�F03-6225-2062<br>

**************************************************************  <br> 
			</TD>
			</TR>
			
			
			
			<TR>
			<TD>
			</TD>
			</TR>
			<TR>
			<TD>
			<input type="submit" value="���M" >
			</TD>
			</TR>
			</table>
      </form>
	  
      
 
	
</div>
		


</body>
</html>
