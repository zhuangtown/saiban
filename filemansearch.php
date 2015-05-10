<?php
session_start();
if(!isset($_SESSION["user_id"])){
	header("Location: error.php");
}
?>
<?php include('menubar.php'); ?>
<div id="head">
        <div id="title">
			<h1></h1>
<!--            <TABLE WIDTH="100%" BORDER=0 CELLSPACING=4 CELLPADDING=0>----2013/03/22改修----->
            <TABLE WIDTH="100%" BORDER=0>
                <TR ALIGN="CENTER" WIDTH="">
<!--                    <TD WIDTH="5%"><IMG SRC='img/ekintai1.gif' BORDER='0'>----2013/03/22改修----->
                    <TD WIDTH="5%"><IMG SRC='img/logo.png' BORDER='0'>
<!--                <TD WIDTH="95%"></TD>------2013/03/13改修------------------------------------->
                    <TD WIDTH="65%"></TD>
					<TD ALIGN="left" HEIGHT="35" WIDTH="15%"><INPUT TYPE="BUTTON"
						VALUE="メニュー" onClick="location.href='Menu.php'" class="i-btn"><INPUT
						TYPE="BUTTON" VALUE="ログアウト" onClick="location.href='Login.php'"
						class="i-btn"></TD>
				</TR>
			</TABLE>
		</div>
	</div>

	<div class="list">
		<h3 align="center">
<!-- 			<span style="color: gray">Filemanマスタ</span>-------2013/03/15改修-------------->
			<span style="color: darkslategray">帳票一覧</span>
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

	include_once './Includes/DBconnect.php';
	//DBへ接続
	$db=DBconnect();
	mysql_set_charset('sjis');
	
	//2014-10-30
	$sql_kind = "SELECT name FROM doctype";
    $res_kind = mysql_query($sql_kind, $db) or die("DB putout error");
	$sql_customer = "SELECT name FROM customer";
    $res_customer = mysql_query($sql_customer, $db) or die("DB putout error");
    ?>
	<form action=filemanMainten.php method=post>
	  <div class="list">
	    <table class="l-tbl">
          <col width="20%">
          <col width="60%">
          <TR>
            <TH class="l-cellsec">種類</TH>
            <TD class="l-cellodd"><select name="inpKind">
            <option value="" selected="selected">
           <?php $Count = 0;
                    while($row=mysql_fetch_array($res_kind))
                    {
                        $WorkName[$Count] = $row[0];
                            
                        ?>
                <option value="<?php echo $WorkName[$Count]?>">
                             <?php echo $WorkName[$Count]?>
                <?php 
                                $Count++;
                    }
                    ?>
              </select>
            </TD>
          </TR>
          <TR>
            <TH class="l-cellsec">月</TH>
            <TD class="l-cellodd"><select name="inpDepartment">
             <option value=" " selected="selected">
             <option value="01">01
             <option value="02">02
             <option value="03">03
             <option value="04">04
             <option value="05">05
             <option value="06">06
             <option value="07">07
             <option value="08">08
             <option value="09">09
             <option value="10">10
             <option value="11">11
             <option value="12">12
                
              </select>
            </TD>
          </TR>
          <TR>
            <TH class="l-cellsec">取引先名</TH>
            <TD class="l-cellodd"><select name="inpCustomer">
               <option value="" selected="selected">
                <?php 
                    $Count = 0;
                    while($row=mysql_fetch_array($res_customer))
                    {
                        $WorkName[$Count] = $row[0];
                        ?>
                <option value="<?php echo $WorkName[$Count]?>">
                             <?php echo $WorkName[$Count]?>
                <?php 
                                $Count++;
                    }
                    ?>
              </select>
            </TD>
          </TR>
        </table>
	    <BR>
        <input type="submit" value="選択" name="submit" class="m-btn" />
      </div>
      </body>
      </html>