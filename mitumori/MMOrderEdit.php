<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);//shutdown error wwarining!!
session_start();
mb_language("Japanese");
if(!isset($_SESSION["user_id"])){
    header("Location: error.php");
}
include 'MMOrderFormat.php';
//確認ボタン押す場合
if(isset($_POST['confirm'])){
    include("../Includes/orders.php");
    $errorMsgs = validate();
    //バリデーションを通る場合、確認画面へ
    if($errorMsgs == ""){
        require('MMOrderEditConfirm.php');
        exit;
    }
}

//テキストファイルからデータを読み込む
$payCondition = "";
$explanation = "";
$yukokikan="";
$goods="";
$WorkPlace="";
if (!($payCondition = file_get_contents("../files/payCondition.txt"))) {
    echo "ファイルが開けません。";
}
if (!($explanation = file_get_contents("../files/explanation.txt"))) {
    echo "ファイルが開けません。";
}
if (!($yukokikan = file_get_contents("./files/yukokikan.txt"))) {
	echo "1ファイルが開けません。";
}
if (!($goods = file_get_contents("./files/goods.txt"))) {
	echo "2ファイルが開けません。";
}
if (!($WorkPlace = file_get_contents("./files/WorkPlace.txt"))) {
	echo "3ファイルが開けません。";
}
header('Cache-Control:no-cache');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Shift-JIS">
<meta http-equiv="Content-Style-Type" content="text/css">
<link href="../css/common.css" rel="stylesheet" type="text/css">
<TITLE>受発注書類システム</TITLE>
<script src="../js/calendar.js" language="JavaScript"></script>
</head>
<body id="doc">
    <div id="head">
        <div id="title">
            <h1></h1>

            <TABLE WIDTH="100%" BORDER=0>
                <TR ALIGN="CENTER" WIDTH="">
                    <TD WIDTH="5%"><IMG SRC='../img/logo.png' BORDER='0'>
                    </TD>
                    <TD WIDTH="65%"></TD>
                    <TD ALIGN="left" HEIGHT="35" WIDTH="15%"><INPUT TYPE="BUTTON"
                        VALUE="メニュー" onClick="location.href='../Menu.php'" class="i-btn"><INPUT
                        TYPE="BUTTON" VALUE="ログアウト" onClick="location.href='../Login.php'"
                        class="i-btn">
                    </TD>
                </TR>
            </TABLE>
        </div>
    </div>
    <form action=MMOrderEdit.php method=post name=order>
        <div class="list">
            <h3 align="center">
                <span style="color: gray"></span>
            </h3>
            <?php 
            if(isset($errorMsgs))echo $errorMsgs;
            ?>
            <table class="l-tbl">
                <col width="20%">
                <col width="60%">
                <TR>
                    <TH class="l-cellsec">見積番号</TH>
                    <TD class="l-cellodd"><input type="text" name="saibanRes" readonly=true value="<?php if(isset($_POST['saibanRes'])){echo $_POST['saibanRes'];}else{echo $_GET['saiban_res'];}?>" style="width: 300" maxlength="225">
                    </TD>
                </TR>
                <TR>
                <TH class="l-cellsec">見積有効期限</TH>
                <TD class="l-cellodd"><input type="text" name="yukokikan" style="width:300" maxlength="255" value="<?php if(isset($_POST['yukokikan'])){echo $_POST['yukokikan'];}else{echo $yukokikan;}?>" >
                </TD>
		       </TR>
                <TR>
                    <TH class="l-cellsec">件名</TH>
                    <TD class="l-cellodd"><input type="text" name="workName" style="width: 300" maxlength="225" value="<?php if(isset($_POST['workName'])){echo $_POST['workName'];}?>">
                    </TD>
                </TR>
                <TR>
                    <TH class="l-cellsec">納入物件</TH>
                    <TD class="l-cellodd"><input type="text" name="goods" style="width: 300" maxlength="225" value="<?php if(isset($_POST['goods'])){echo $_POST['goods'];}else{echo $goods;}?>">
                    </TD>
                </TR>
                    <TR>
                    <TH class="l-cellsec">納入場所</TH>
                    <TD class="l-cellodd"><input type="text" name="station" value="<?php if(isset($_POST['station'])){echo $_POST['station'];}else{echo $WorkPlace;}?>" style="width: 300" maxlength="225">
                    </TD>
                </TR>
                <TR>
                    <TH class="l-cellsec">作業内容</TH>
                    <TD class="l-cellodd"><input type="text" name="workContents" value="<?php if(isset($_POST['workContents'])){echo $_POST['workContents'];}?>" style="width: 300" maxlength="225" onBlur="this.form.wk_1_stepContents.value=this.form.workContents.value;">
                    </TD>
                </TR>
                <TR>
                    <TH class="l-cellsec">作業期間</TH>
                    <TD class="l-cellodd">
                    <input type="text" name="periodStart" value="<?php if(isset($_POST['periodStart'])){echo $_POST['periodStart'];}?>" style="width: 95">
                    <input type="button" onClick="wrtCalendar(event,this.form.periodStart,'yyyy/m/d');" style="background-image: url(calendar.gif); background-color:#5483B6; color: #ffffff; width:35px; height:20px; border:0; cursor:pointer;" value="開始" name="Calendar">
                    ～
                    <input type="text" name="periodEnd" value="<?php if(isset($_POST['periodEnd'])){echo $_POST['periodEnd'];}?>" style="width: 95">
                    <input type="button" onClick="wrtCalendar(event,this.form.periodEnd,'yyyy/m/d');" style="background-image: url(calendar.gif); background-color:#5483B6; color: #ffffff; width:35px; height:20px; border:0; cursor:pointer;" value="終了" name="Calendar">
                    </TD>
                </TR>
                
                <TR>
                    <TH class="l-cellsec">作業場所</TH>
                    <TD class="l-cellodd"><input type="text" name="workPlace" value="<?php if(isset($_POST['workPlace'])){echo $_POST['workPlace'];}else{echo $WorkPlace;}?>" style="width: 300" maxlength="225">
                    </TD>
                </TR>
                <TR>
                    <TH class="l-cellsec">支払条件</TH>
                    <TD class="l-cellodd"><input type="text" name="payCondition" value="<?php if(isset($_POST['payCondition'])){echo $_POST['payCondition'];}else{echo $payCondition;}?>" style="width: 300" maxlength="225">
                    </TD>
                </TR>
            
            </table>
        </div>
        <div class="list">
        <table class="l-tbl">
            <col width="3%">
            <col width="16%">
            <col width="9%">
            <col width="9%">
            <col width="9%">
        
            <col width="9%">
            <col width="9%">
          
            <col width="9%">
            <TR>
                <TH class="l-cellcenter">No.</TH>
                <TH class="l-cellcenter">作業内容</TH>
                <TH class="l-cellcenter">数量(人月)</TH>
                <TH class="l-cellcenter">単価(円)</TH>
                <TH class="l-cellcenter">上限時間（H）</TH>
                <TH class="l-cellcenter">下限時間（H）</TH>
            </TR>
            <?php 
            for($i=1;$i<=10;$i++){
            ?>
            <TR>
                <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_id" value="<?php if(isset($_POST['wk_'.$i.'_id'])){echo $_POST['wk_'.$i.'_id'];}else{echo $i;}?>" readonly=true style="background: transparent; border-width: 0px; width: 100%">
                </TD>
                <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_stepContents" value="<?php if(isset($_POST['wk_'.$i.'_stepContents'])){echo $_POST['wk_'.$i.'_stepContents'];}?>" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
                <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_number" value="<?php if(isset($_POST['wk_'.$i.'_number'])){echo $_POST['wk_'.$i.'_number'];}?>" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
                <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_unitPrice" value="<?php if(isset($_POST['wk_'.$i.'_unitPrice'])){echo $_POST['wk_'.$i.'_unitPrice'];}?>" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
                <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_addtime" value="<?php if(isset($_POST['wk_'.$i.'_addtime'])){echo $_POST['wk_'.$i.'_addtime'];}?>" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
                <TD class="l-cellodd"><input type="text" name="wk_<?php echo $i?>_subtracttime" value="<?php if(isset($_POST['wk_'.$i.'_subtracttime'])){echo $_POST['wk_'.$i.'_subtracttime'];}?>" style="background: transparent; border-width: 0px; width: 100%">
                </TD>
                
                
            </TR>
            <?php 
            }
            ?>
        </table>
        <table class="l-tbl">
            <TR>
                <TD class="l-cellodd">
                    <textarea name="explanation" cols=137% height:35px;s=10 value=""><?php if(isset($_POST['explanation'])){echo $_POST['explanation'];}else{echo $explanation;}?>
                    </textarea>
                </TD>
            </TR>
            <TR>
                <TD align=center><br>
                    <input type="submit" name="confirm" value="確認">
                </TD>
            </TR>
        </table>
    </div>
    </form>
</body>
</html>