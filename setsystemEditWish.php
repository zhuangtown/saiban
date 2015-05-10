<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);//shutdown error wwarining!!
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
<!--            <TABLE WIDTH="100%" BORDER=0 CELLSPACING=4 CELLPADDING=0>----2013/03/14â¸èC----->
            <TABLE WIDTH="100%" BORDER=0>
                <TR ALIGN="CENTER" WIDTH="">
<!--                    <TD WIDTH="5%"><IMG SRC='img/ekintai1.gif' BORDER='0'>----2013/03/14â¸èC----->
                    <TD WIDTH="5%"><IMG SRC='img/logo.png' BORDER='0'>
                    </TD>
<!--                <TD WIDTH="95%"></TD>------2013/03/13â¸èC------------------------------------->
                    <TD WIDTH="65%"></TD>
                    <TD ALIGN="left" HEIGHT="35" WIDTH="15%">
                    </TD>
                </TR>
            </TABLE>
        </div>
    </div>
    <form action=setsyssave.php method=post name=setsys>
        <div class="list">
            <h3 align="center">
                <span style="color: gray"></span>
            </h3>
           
            <table class="l-tbl">
                <col width="20%">
                <col width="60%">
                <TR>
                    <TH class="l-cellsec">óXï÷î‘çÜ</TH>
                    <TD class="l-cellodd"><input type="text" name="postcode" style="width: 300" maxlength="225" >
                    </TD>
                </TR>
                <TR>
                    <TH class="l-cellsec">èZèä</TH>
                    <TD class="l-cellodd"><input type="text" name="address" style="width: 300" maxlength="225">
                    </TD>
                </TR>
               <TR>
                    <TH class="l-cellsec">ìdòbî‘çÜ</TH>
                    <TD class="l-cellodd"><input type="text" name="tel" style="width: 300" maxlength="225">
                    </TD>
                </TR><TR>
                    <TH class="l-cellsec">ÉtÉHÉNÉX</TH>
                    <TD class="l-cellodd"><input type="text" name="fax" style="width: 300" maxlength="225" >
                    </TD>
                </TR>
                
        <div class="list">
        <table class="l-tbl">
            
            <TR>
                <TD align=center><br>
                    <input type="submit" name="sysck" value="ämîF">
                </TD>
            </TR>
        </table>
    </div>
    </form>
 

</body>
</html>