 <?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);
session_start();
mb_language("Japanese");
if(!isset($_SESSION["user_id"])){
    header("Location: error.php");
}
header('Cache-Control:no-cache');
?>
<?php include('menubar.php'); ?>
<div id="head">
        <div id="title">
            <h1></h1>
            <TABLE WIDTH="100%" BORDER=0>
                <TR ALIGN="CENTER" WIDTH="">
                    <TD WIDTH="5%"><!--<IMG SRC='img/logo.png' BORDER='0'>-->
                    </TD>
                    <TD WIDTH="65%"></TD>
                    <TD ALIGN="left" HEIGHT="35" WIDTH="15%">
                    </TD>
                </TR>
            </TABLE>
        </div>
    </div>
	 <form action=autooppsave.php method=post name=order>
 <div class="list">
        <table class="l-tbl">
            <col width="3%">
            <col width="16%">
            <col width="9%">
            <col width="9%">
            <col width="9%">
            <col width="9%">
            <col width="18%">
            <col width="9%">
            <col width="9%">
            <col width="9%">
            <TR>
                <TH class="l-cellcenter">No.</TH>
                <TH class="l-cellcenter">社名</TH>
                <TH class="l-cellcenter">営業ご担当者</TH>
                <TH class="l-cellcenter">メールアドレス</TH>
                <TH class="l-cellcenter">〒</TH>
                <TH class="l-cellcenter">肩書</TH>
                <TH class="l-cellcenter">住所</TH>
				<TH class="l-cellcenter">電話</TH>
				<TH class="l-cellcenter">携帯電話</TH>
				<TH class="l-cellcenter">備考欄</TH>
            </TR>
            <?php 
            for($i=1;$i<=10;$i++){
             ?>
            <TR>
                <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_id" value="<?php if(isset($_POST['wk_'.$i.'_id'])){echo $_POST['wk_'.$i.'_id'];}else{echo $i;}?>" readonly=true style="background: transparent; border-width: 0px; width: 100% ;text-align: center;">
                </TD>
                <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_company" value="<?php if(isset($_POST['wk_'.$i.'_company'])){echo $_POST['wk_'.$i.'_company'];}?>" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
                <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_manager" value="<?php if(isset($_POST['wk_'.$i.'_manager'])){echo $_POST['wk_'.$i.'_manager'];}?>" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
                <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_email" value="<?php if(isset($_POST['wk_'.$i.'_email'])){echo $_POST['wk_'.$i.'_email'];}?>" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
                <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_zip_code" value="<?php if(isset($_POST['wk_'.$i.'_zip_code'])){echo $_POST['wk_'.$i.'_zip_code'];}?>" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
                <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_position" value="<?php if(isset($_POST['wk_'.$i.'_position'])){echo $_POST['wk_'.$i.'_position'];}?>" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
                 <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_address" value="<?php if(isset($_POST['wk_'.$i.'_address'])){echo $_POST['wk_'.$i.'_address'];}?>" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
                <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_tel" value="<?php if(isset($_POST['wk_'.$i.'_tel'])){echo $_POST['wk_'.$i.'_tel'];}?>" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
                   <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_mobile" value="<?php if(isset($_POST['wk_'.$i.'_mobile'])){echo $_POST['wk_'.$i.'_mobile'];}?>" style="background: transparent; border-width: 0px; width: 100%">
              </TD>
                <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_other" value="<?php if(isset($_POST['wk_'.$i.'other'])){echo $_POST['wk_'.$i.'_other'];}?>" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
            </TR>
            <?php 
            }
            ?>
        </table>
        <table class="l-tbl">
           
            <TR>
                <TD align=center><br>
                    <input type="submit" name="autook" value="保存">
                </TD> </form>
				<TD><?php
	                if(isset($_POST["autook"])){
                    require('autooppsave.php');
					echo "保存しました";
                    }?>
          </TD>
            </TR>
        </table>
    </div>
   
</body>
</html>