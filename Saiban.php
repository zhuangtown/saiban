<?php
session_start();
mb_language("Japanese");
if(!isset($_SESSION["user_id"])){
    header("Location: Login.php");
}
?>

<?php include('menubar.php'); ?>

    <div id="head">
        <div id="title">
            <h1></h1>
<!--            <TABLE WIDTH="100%" BORDER=0 CELLSPACING=4 CELLPADDING=0>----2013/03/14改修----->
            <TABLE WIDTH="100%" BORDER=0>
                <TR ALIGN="CENTER" WIDTH="">
<!--                    <TD WIDTH="5%"><IMG SRC='img/logo.png' BORDER='0'>----2013/03/14改修----->
                    <TD WIDTH="5%"><!--<IMG SRC='img/logo.png' BORDER='0'>-->
                    </TD>
             <TD WIDTH="95%"></TD>
                    <TD WIDTH="65%"></TD>
                <!--------2013/03/13改修---2015/2/9
				<TD ALIGN="left" HEIGHT="35" WIDTH="15%"><INPUT TYPE="BUTTON"
                        VALUE="メニュー" onClick="location.href='Menu.php'" class="i-btn"><INPUT
                        TYPE="BUTTON" VALUE="ログアウト" onClick="location.href='Login.php'"
                        class="i-btn">
                    </TD>---------------------------------->
                </TR>
            </TABLE>
        </div>
    </div>
	<BR>
    <?php
	include_once './orderclass.php';
    include_once './Includes/DBconnect.php';
    //DBへ接続
    $db=DBconnect();

    mysql_set_charset('sjis');
    // データを取り出す
    $sql_kind = "SELECT name FROM doctype";
    $res_kind = mysql_query($sql_kind, $db) or die("DB putout error");

    $sql_department = "SELECT department FROM department";
    $res_department = mysql_query($sql_department, $db) or die("DB putout error");

    $sql_customer = "SELECT name FROM customer";
    $res_customer = mysql_query($sql_customer, $db) or die("DB putout error");

    header('Cache-Control:no-cache');

    ?>

    <form action=Saiban.php method=post>
        <div class="list">
            <h3 align="center">
<!--                <span style="color: gray">採番システム</span>-------2013/03/15改修-------------->
                <span style="color: darkslategray">受発注書類作成</span>
            </h3>
            <table class="l-tbl">
                <col width="20%">
                <col width="60%">
                <TR>
                    <TH class="l-cellsec">種類</TH>
                    <TD class="l-cellodd"><select name="inpKind">
                    <?php 
                    $Count = 0;
                    while($row=mysql_fetch_array($res_kind))
                    {
                        $WorkName[$Count] = $row[0];
                            
                        ?>
                            <option value="<?php echo $WorkName[$Count]?>"
                            <?php if(isset($_POST['inpKind'])){if(mb_convert_encoding($_POST['inpKind'], "SJIS", "auto")==$WorkName[$Count]){echo("selected");}}?>>
                                <?php echo $WorkName[$Count]?>
                                <?php 
                                $Count++;
                    }
                    ?>
                    
                    </select>
                    </TD>
                </TR>
                <TR>
                    <TH class="l-cellsec">事業部</TH>
                    <TD class="l-cellodd"><select name="inpDepartment">
                    <?php 
                    $Count = 0;
                    while($row=mysql_fetch_array($res_department))
                    {
                        $WorkName[$Count] = $row[0];
                        ?>
                            <option value="<?php echo $WorkName[$Count]?>"
                            <?php if(isset($_POST['inpDepartment'])){if(mb_convert_encoding($_POST['inpDepartment'], "SJIS", "auto")==$WorkName[$Count]){echo("selected");}}?>>
                                <?php echo $WorkName[$Count]?>
                                <?php 
                                $Count++;
                    }
                    ?>
                    
                    </select>
                    </TD>
                </TR>
                <TR>
                    <TH class="l-cellsec">取引先コード</TH>
                    <TD class="l-cellodd"><select name="inpCustomer">
                    <?php 
                    $Count = 0;
                    while($row=mysql_fetch_array($res_customer))
                    {
                        $WorkName[$Count] = $row[0];
                        ?>
                            <option value="<?php echo $WorkName[$Count]?>"
                            <?php if(isset($_POST['inpCustomer'])){if(mb_convert_encoding($_POST['inpCustomer'], "SJIS", "auto")==$WorkName[$Count]){echo("selected");}}?>>
                                <?php echo $WorkName[$Count]?>
                                <?php 
                                $Count++;
                    }
                    ?>
                    
                    </select>
                    </TD>
                </TR>
            </table>
            <BR> <input type="submit" value="番号作成" name="submit" class="m-btn" />
        </div>
        <BR>
        <div class="list">
        <?php 
        if(isset($_POST['submit'])& isset($_POST['inpKind'])&isset($_POST['inpDepartment'])&isset($_POST['inpCustomer']))
        {
            //選択した値を取る⇒SJISに変換
            $inpKind=mb_convert_encoding($_POST['inpKind'], "SJIS", "auto");
            $inpDepartment=mb_convert_encoding($_POST['inpDepartment'], "SJIS", "auto");
            $inpCustomer=mb_convert_encoding($_POST['inpCustomer'], "SJIS", "auto");

            mysql_set_charset('sjis');
            //種類
            $sql_kind = "SELECT code FROM doctype where name='".$inpKind."'";
            $res_kind = mysql_query($sql_kind, $db) or die("DB putout error");
            $row_kind=mysql_fetch_array($res_kind);
            //事業部
            $sql_Department = "SELECT code FROM department where department='".$inpDepartment."'";
            $res_Department = mysql_query($sql_Department, $db) or die("DB putout error");
            $row_Department=mysql_fetch_array($res_Department);
            //お客さんコード
            $sql_Customer = "SELECT code FROM customer where name='".$inpCustomer."'";
            $res_Customer = mysql_query($sql_Customer, $db) or die("DB putout error");
            $row_Customer=mysql_fetch_array($res_Customer);

            ?>
            <span class="txt-black1">選択した内容は：</span>
            <table class="l-tbl">
                <col width="20%">
                <col width="60%">
                <TR>
                    <TH class="l-cellsec">種類</TH>
                    <TD class="l-cellodd"><?php echo $inpKind."(".$row_kind[0].")"?></TD>
                </TR>
                <TR>
                    <TH class="l-cellsec">事業部</TH>
 <!--                   <TD class="l-cellodd"><?php echo $inpDepartment."(".$row_Department[0].")"?>  ---->
                    <TD class="l-cellodd"><?php echo $inpDepartment?>
                    </TD>
                </TR>
                <TR>
                    <TH class="l-cellsec">会計年度（年）</TH>
                    <TD class="l-cellodd"><?php echo date("Y")." 年"?></TD>
                </TR>
                <TR>
                    <TH class="l-cellsec">会計年度（月）</TH>
                    <TD class="l-cellodd"><?php echo date("n")." 月"?></TD>
                </TR>
                <TR>
                    <TH class="l-cellsec">取引先コード</TH>
 <!--                    <TD class="l-cellodd"><?php echo $inpCustomer."(".$row_Customer[0].")"?></TD>  ---->
                    <TD class="l-cellodd"><?php echo $inpCustomer?></TD>
                </TR>
                <?php 
                //番号をつながる
                $saiban_kari=$row_kind[0].$row_Department[0].date("y").date("m").$row_Customer[0];
                //⇒SJISに変換
                $saiban_kari=mb_convert_encoding($saiban_kari, "SJIS", "auto");

                print "<br>";

                $sql_kakunin = "SELECT seqno FROM fileman where seqno like '".$saiban_kari."%"."' order by seqno";
                $res_kakunin = mysql_query($sql_kakunin, $db) or die("DB putout error");
                //データ数をCOUNT
                $sql_maxCount = "SELECT COUNT(*) FROM fileman where seqno like '".$saiban_kari."%"."' order by seqno";
                $res_maxCount = mysql_query($sql_maxCount, $db) or die("DB putout error");
                $row_maxCount = mysql_fetch_array($res_maxCount);

                $index=1;
                //DBにすでに存在するかどうかを確認する
                if($row_kakunin = mysql_fetch_array($res_kakunin)){
                    //print "data find <br> ";
                    do
                    {
                        $no_count=intval(substr($row_kakunin[0],11,3));
                        if($index<>$no_count){
                            if($index<10){
                                $index=sprintf("00%s",$index);
                            }elseif($index>=10 & $index<=99){
                                $index=sprintf("0%s",$index);
                            }elseif($index>=100 & $index<=999){
                                $index=sprintf("%s",$index);
                            }
                            $saiban_res=mb_convert_encoding($saiban_kari.$index, "SJIS", "auto");
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
                                //print "欠番がありませんので、採番します。<br>";
                                $saiban_res=mb_convert_encoding($saiban_kari.$index, "SJIS", "auto");
                                break;
                            }
                        }
                        $index++;
                    }while($row_kakunin = mysql_fetch_array($res_kakunin));
                }
                else{
                    //print "同類番号存在しませんので、００１の番号で採番します。<br>";
                    $saiban_res=mb_convert_encoding($saiban_kari."001", "SJIS", "auto");
                    //print "採番番号は：".$saiban_res;
                }

                //print "<h2>採番番号は：".$saiban_res."<h2>";
                ?>
                <TR>
                    <TH class="l-cellsec">採番番号</TH>
                    <TD class="l-cellodd"><input type="text" name="saiban_res"
                        value="<?php echo $saiban_res?>" readonly=true
                        style="background: transparent; border-width: 0px; color: #FF0000">
                    </TD>
                </TR>
            </table>
            <BR> <input type="submit" value=<?php echo $inpKind."作成" ?> name="insert" class="m-btn" onclick=<?php orderclass($row_kind[0],$saiban_res);?> />
            <!--  <input type="button" value="注文書作成" name="orderSheet" onclick="window.open('OrderEdit.php?saiban_res=<?php echo $saiban_res?>;');" class="m-btn" />-->
            <!-- 20120416に追加--------------- -->
            <?php 
        }

        if(isset($_POST['insert'])) {
            mysql_set_charset('sjis');
            //INSERT
            $saiban_res=$_POST['saiban_res'];

            $sql_resCheck = "SELECT seqno FROM fileman where seqno='".$saiban_res."'";
            $res_resCheck = mysql_query($sql_resCheck, $db) or die("DB putout error");
            $row_resCheck=mysql_fetch_array($res_resCheck);

            if($row_resCheck[0]!=""){
                    
                ?>
            <span class="txt-attention">保存できませんでした。再番号作成してください。</span>
            <?php 
            }
            else{
                $sql_insert = "INSERT INTO fileman (seqno,typecode,depcode,custcode,filepath,filename,updateuser,updatetime,version) VALUES ('".$saiban_res."', '".substr($saiban_res,0,1)."','".substr($saiban_res,1,3)."','".substr($saiban_res,8,3)."',NULL,NULL,'yin_test',CURRENT_TIMESTAMP,'1')";
                //print $sql_insert."<br>";
                $res_insert = mysql_query($sql_insert, $db) or die("DB putout error");
                ?>
            <span class="txt-attention">保存しました。</span>
            <?php 
            }

        }

        ?>
        </div>
    </form>
</body>
</html>