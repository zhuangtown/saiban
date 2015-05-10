<?php
session_start();
mb_language("Japanese");
if(!isset($_SESSION["user_id"])){
    header("Location: error.php");
}

if(isset($_POST["orderPdf"])){//íçï∂èëçÏê¨
    include("./Includes/Components/orderToPdf.php");
    orderToPdf();
}

header('Cache-Control:no-cache');
?>
<?php include('menubar.php'); ?>
<div id="head">
        <div id="title">
            <h1></h1>
            <TABLE WIDTH="100%" BORDER=0 CELLSPACING=4 CELLPADDING=0>
                <TR ALIGN="CENTER" WIDTH="">
                    <TD WIDTH="5%"><IMG SRC='img/logo.png' BORDER='0'>
                    </TD>
                    <TD WIDTH="95%"></TD>
                    <TD ALIGN="left" HEIGHT="35" WIDTH="15%">
                    </TD>
                </TR>
            </TABLE>
        </div>
    </div>
    <form action=OrderEditFinish.php method=post name=order>
        <div class="list">
            <h3 align="center">
            </h3>
            <table class="l-tbl">
                <col width="20%">
                <col width="60%">
                <TR>
                    <TH class="l-cellsec"></TH>
                    <TD class="l-cellodd">
                    ï€ë∂äÆóπÅI
                    <input type="hidden" name="saibanRes" value="<?php echo $_GET["saibanRes"]?>">
                    </TD>
                </TR>
                <TR>
                    <input type="submit" name="orderPdf" value="í†ï[çÏê¨">
                </TR>
            </table>
        </div>
    </div>
    </form>
</body>
</html>