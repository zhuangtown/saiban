<?php
session_start();
mb_language("Japanese");
if(!isset($_SESSION["user_id"])){
    header("Location: ../error.php");
}

if(isset($_POST["orderPdf"])){//注文書作成
    include("../Includes/Components/TmsorderToPdf.php");
    TmsorderToPdf();
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
            <TABLE WIDTH="100%" BORDER=0 CELLSPACING=4 CELLPADDING=0>
                <TR ALIGN="CENTER" WIDTH="">
                    <TD WIDTH="5%"><IMG SRC='../img/logo.png' BORDER='0'>
                    </TD>
                    <TD WIDTH="95%"></TD>
                    <TD ALIGN="left" HEIGHT="35" WIDTH="15%"><INPUT TYPE="BUTTON"
                        VALUE="メニュー" onClick="location.href='../Menu.php'" class="i-btn"><INPUT
                        TYPE="BUTTON" VALUE="ログアウト" onClick="location.href='../Login.php'"
                        class="i-btn">
                    </TD>
                </TR>
            </TABLE>
        </div>
    </div>
    <form action=TmsOrderEditFinish.php method=post name=order>
        <div class="list">
            <h3 align="center">
            </h3>
            <table class="l-tbl">
                <col width="20%">
                <col width="60%">
                <TR>
                    <TH class="l-cellsec"></TH>
                    <TD class="l-cellodd">
                    保存完了！
                    <input type="hidden" name="saibanRes" value="<?php echo $_GET["saibanRes"]?>">
                    </TD>
                </TR>
                <TR>
                    <input type="submit" name="orderPdf" value="帳票作成">
                </TR>
            </table>
        </div>
    </div>
    </form>
</body>
</html>