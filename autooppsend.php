<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);//shutdown error wwarining!!
session_start();
if(!isset($_SESSION["user_id"])){
	header("Location: Login.php");
}
$case = "";
if (!($case = file_get_contents("files/case.txt"))) {
    echo "ファイルが開けません。";
}
?>


<?php include('menubar.php'); ?>
	<div id="head">
	</div>
	<?php

	include_once './Includes/DBconnect.php';
	//DBへ接続
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
                <TH class="width: 8px;">社名</TH>
                <TH class="width: 5px;">営業ご担当者</TH>
                <TH class="width: 10px;">メールアドレス</TH>
                <TH class="width: 5px;">〒</TH>
                <TH class="width: 5px;">肩書</TH>
                <TH class="width: 15px;">住所</TH>
				<TH class="width: 5px;">電話</TH>
				<TH class="width: 5px;">携帯電話</TH>
				<TH class="width: 6px;">備考欄</TH>
				<TH class="width: 6px;">発信</TH>
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
			メール件名
			</TD>
			<TD>
			案件情報- シンメトリクス<?php echo date("ymd");?>
			</TD>
			</TR>
			<TR>
			<TD>
			メール内容
			</TD>
			<TD>
			いつもお世話になっております。株式会社シンメトリクス葛でございます。
			</TD>
			</TR>
			<TR>
			<TD>
			</TD>
			<TD>
			<table>
			<TR>
			<TD>
			【案件名】  　：
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
			【案件詳細】 ：
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
		何卒よろしくお願い申し上げます。<br>

【特記事項】<br>
＊本案件上は、インターネット上の公開、メルマガ等の掲載・他社転送をご遠慮下さい。<br>
＊ご提案後、当方より3日営業日を過ぎても連絡がなかった場合は、<br>
見送りとご判断頂くことをご了承願います。<br>

*************************************************************<br>
株式会社シンメトリクス　http://www.symmetrix.co.jp<br>
営業共通メールアドレス：sales@symmetrix.co.jp　<br>
陳　敏玲(チン　ビンレイ)            080-3933-7227<br>
森島　英仁(モリシマ ヒデヒト)　  　080-3502-2882<br>
葛　明(カツ メイ)                      090-3206-3463<br>

〒103-0023<br>
東京都中央区日本橋本町4-4-11 永井ビル７階<br>
Tel：03-6225-2882 Fax：03-6225-2062<br>

**************************************************************  <br> 
			</TD>
			</TR>
			
			
			
			<TR>
			<TD>
			</TD>
			</TR>
			<TR>
			<TD>
			<input type="submit" value="送信" >
			</TD>
			</TR>
			</table>
      </form>
	  
      
 
	
</div>
		


</body>
</html>
