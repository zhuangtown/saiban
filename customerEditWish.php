<?php
session_start();
mb_language("Japanese");
if(!isset($_SESSION["user_id"])){
	header("Location: error.php");
}
include_once './Includes/DBconnect.php';
//DBへ接続
$db=DBconnect();
mysql_set_charset('sjis');
/** Initialize $wishDescriptionIsEmpty */
$wishDescriptionIsEmpty = false;
$noUniqueCode = false;//20120416に追加
$rollBack = false;//20120416に追加
if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//戻るのチェック
	if (array_key_exists("back", $_POST)) {
		header('Location: customerMainten.php');
		exit;
	}
	else if(isset($_POST['saveWish'])){
        /*20120416に追加start*/
        //更新時コードの変更はない場合のみでユニークチェック
        if (!(!empty($_POST['wishID']) && ($_POST['wishID'] == $_POST['code']))) {
            //ユニークコードバリデーション
            $unique_code = mb_convert_encoding($_POST['code'], "SJIS", "auto");
            $sql_uniqueCode_count = "select count(*) from customer where code = '" . $unique_code . "'";
            $res_uniqueCode_count = mysql_query($sql_uniqueCode_count, $db) or die("DB putout error4");
            $row_uniqueCode_count = mysql_fetch_array($res_uniqueCode_count);
            $uniqueCode_count = $row_uniqueCode_count['count(*)'];
        }
        
        if($uniqueCode_count > 0){
            $noUniqueCode = true;/*end20120416に追加*/
        }else if ($_POST['name'] == "") {
			$wishDescriptionIsEmpty = true;
		//}else if ($_POST['wishID'] == "") {
        }else if ($_POST['wishID'] != $_POST['code']) {//20120416に追加
			//insert
			$insert_code=mb_convert_encoding($_POST['code'], "SJIS", "auto");
			$insert_name=mb_convert_encoding($_POST['name'], "SJIS", "auto");
			//<!2014-10-22------------------------------------------------------------------->
			$insert_owner=mb_convert_encoding($_POST['owner'], "SJIS", "auto");
			$insert_mail=mb_convert_encoding($_POST['mail'], "SJIS", "auto");
			$insert_postcode=mb_convert_encoding($_POST['postcode'], "SJIS", "auto");
			$insert_address=mb_convert_encoding($_POST['address'], "SJIS", "auto");
			$insert_manager1=mb_convert_encoding($_POST['manager1'], "SJIS", "auto");
			$insert_mail1=mb_convert_encoding($_POST['mail1'], "SJIS", "auto");
			$insert_manager2=mb_convert_encoding($_POST['manager2'], "SJIS", "auto");
			$insert_mail2=mb_convert_encoding($_POST['mail2'], "SJIS", "auto");
			$insert_tel=mb_convert_encoding($_POST['tel'], "SJIS", "auto");
			$insert_fax=mb_convert_encoding($_POST['fax'], "SJIS", "auto");;
			//<!2014-10-22------------------------------------------------------------------------->
            $sql_Customer="BEGIN";//20120416に追加
            $res_Customer = mysql_query($sql_Customer, $db) or die("DB putout error3");//20120416に追加
			$sql_Customer="INSERT INTO customer (code,name,owner,mail,postcode,address,manager1,mail1,manager2,mail2,tel,fax,tmp1,tmp2,tmp3,updateuser,updatetime,version) VALUES ('".$insert_code."', '".$insert_name."','".$insert_owner."','".$insert_mail."','".$insert_postcode."','".$insert_address."','".$insert_manager1."','".$insert_mail1."','".$insert_manager2."','".$insert_mail2."','".$insert_tel."','".$insert_fax."' ,NULL,NULL,NULL,'yin_test',CURRENT_TIMESTAMP,'1')";
			$res_Customer = mysql_query($sql_Customer, $db) or die("DB putout error2");
            /*20120416に追加start*/
            if(!empty($_POST['wishID'])){
                $sql_Customer = "DELETE FROM customer WHERE code = '".$_POST['wishID']."'";
                $res_Customer = mysql_query($sql_Customer, $db) or die("DB putout error1");
                if(!$res_Customer){
                    $sql_Customer="ROLLBACK";
                    $res_Customer = mysql_query($sql_Customer, $db) or die("DB putout error1");
                    $rollBack = true;
                }else{
                    $sql_Customer="COMMIT";
                    $res_Customer = mysql_query($sql_Customer, $db) or die("DB putout error1");
                }
            }else{
                $sql_Customer="COMMIT";
                $res_Customer = mysql_query($sql_Customer, $db) or die("DB putout error1");
            }
            /*end20120416に追加*/
			header('Location: customerMainten.php');
			exit;
			//update
		} else if ($_POST['name'] != "") {
			$wishID=mb_convert_encoding($_POST['code'], "SJIS", "auto");
			$updName=mb_convert_encoding($_POST['name'], "SJIS", "auto");
			//<!2014-10-22------------------------------------------------------------------->
			$updowner=mb_convert_encoding($_POST['owner'], "SJIS", "auto");
			$updmail=mb_convert_encoding($_POST['mail'], "SJIS", "auto");
			$updpostcode=mb_convert_encoding($_POST['postcode'], "SJIS", "auto");
			$updaddress=mb_convert_encoding($_POST['address'], "SJIS", "auto");
			$updmanager1=mb_convert_encoding($_POST['manager1'], "SJIS", "auto");
			$updmail1=mb_convert_encoding($_POST['mail1'], "SJIS", "auto");
			$updmanager2=mb_convert_encoding($_POST['manager2'], "SJIS", "auto");
			$updmail2=mb_convert_encoding($_POST['mail2'], "SJIS", "auto");
			$updtel=mb_convert_encoding($_POST['tel'], "SJIS", "auto");
			$updfax=mb_convert_encoding($_POST['fax'], "SJIS", "auto");;
			//<!2014-10-22------------------------------------------------------------------------->
			$sql_Customer = "UPDATE customer SET name = '".$updName."',owner='".$updowner."',mail='".$updmail."',postcode='".$updpostcode."',address='".$updaddress."',manager1='".$updmanager1."',mail1='".$updmail1."',manager2='".$updmanager2."',mail2='".$updmail2."',tel='".$updtel."',fax='".$updfax."',updatetime = CURRENT_TIMESTAMP WHERE code = ".$wishID;
			$res_Customer = mysql_query($sql_Customer, $db) or die("DB putout error2");
			header('Location: customerMainten.php');
			exit;
		}
	}
}
?>
<?php include('menubar.php'); ?>
<div id="head">
        <div id="title">
			<h1></h1>
			<TABLE WIDTH="100%" BORDER=0 CELLSPACING=4 CELLPADDING=0>
				<TR ALIGN="CENTER" WIDTH="">
					<TD WIDTH="5%"><IMG SRC='img/logo.png' BORDER='0'></TD>
					<TD WIDTH="95%"></TD>
					<TD ALIGN="left" HEIGHT="35" WIDTH="15%"></TD>
				</TR>
			</TABLE>
		</div>
	</div>

	<div class="list">
		<h3 align="center">
			<span style="color: gray">Customerマスタ</span>
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

	if ($_SERVER['REQUEST_METHOD'] == "POST"){
		//$wish = array("code" => $_POST['code'],"name" => $_POST['name']);
		//\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
        $wish = array("code" => $_POST['wishID'],"name" => $_POST['name'],"owner" => $_POST['owner'],"mail" => $_POST['mail'],"postcode" => $_POST['postcode'],"address" => $_POST['address'],"manager1" => $_POST['manager1'],"mail1" => $_POST['mail1'],"manager2" => $_POST['manager2'],"mail2" => $_POST['mail2'],"tel" => $_POST['tel'],"fax" => $_POST['fax']);//20120416に追加
        
        //\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\
	}
	//修正する場合
	else if (array_key_exists("wishID", $_GET)) {
		//$sql = "SELECT name FROM customer where code='".$_GET['wishID']."'";
        $sql = "SELECT name,code,owner,mail,postcode,address,manager1,mail1,manager2,mail2,tel,fax FROM customer where code='".$_GET['wishID']."'";//20120416に追加
		$res = mysql_query($sql, $db) or die("DB putout error3");
		$row_res=mysql_fetch_array($res);
		$name=$row_res[0];
		$owner=$row_res[2];
		$mail=$row_res[3];
		$postcode=$row_res[4];
		$address=$row_res[5];
		$manager1=$row_res[6];
		$mail1=$row_res[7];
		$manager2=$row_res[8];
		$mail2=$row_res[9];
		$tel=$row_res[10];
		$fax=$row_res[11];
		//------------------------------------------------------------------------------------------------------------------------------------
        $wish = array("code" => $row_res[1], "name" => $row_res[0],"owner" => $row_res[2],"mail" => $row_res[3],"postcode" => $row_res[4],"address" => $row_res[5],"manager1" => $row_res[6],"mail1" => $row_res[7],"manager2" => $row_res[8],"mail2" => $row_res[9],"tel" => $row_res[10],"fax" => $row_res[11], );//20120416に追加
	   //---------------------------------------------------------------------------------------------------------------------------------------------
	
	}
	
	else
	$wish = array("code" => "", "name" => "");
	?>
	<form name="customerEditWish" action="customerEditWish.php"
		method="POST">
		<div class="list">
			<table class="l-tbl">
				<col width="20%">
				<col width="60%">

				<TR>
					<TH class="l-cellsec">取引先コード</TH>
					<TD class="l-cellodd"><input type="hidden" name="wishID"
						value="<?php echo $wish['code']; ?>" /> <input type="text"
						name="code"
						value="<?php 
				if(isset($_POST['code'])){
					echo $_POST['code'];
				}
				else if(array_key_exists("wishID", $_GET)){
					echo $_GET['wishID'];
				}
				else{
					//新規追加の場合、code採番計算	
					$index=1;	
					$sql_maxCount="select count(*) from customer"; //総レコード数
					$res_maxCount = mysql_query($sql_maxCount, $db) or die("DB putout error4");
					$row_maxCount = mysql_fetch_array($res_maxCount);
										
					$sql_kakunin = "SELECT code FROM customer order by code";
					$res_kakunin = mysql_query($sql_kakunin, $db) or die("DB putout error5");
					
					if($row_kakunin = mysql_fetch_array($res_kakunin)){
				
						do
						{
							$no_count=intval($row_kakunin[0]);
							if($index<>$no_count){
								if($index<10){
									$index=sprintf("00%s",$index);
								}elseif($index>=10 & $index<=99){
									$index=sprintf("0%s",$index);
								}elseif($index>=100 & $index<=999){
									$index=sprintf("%s",$index);
								}
								$saiban_res=mb_convert_encoding($index, "SJIS", "auto");
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
									$saiban_res=mb_convert_encoding($index, "SJIS", "auto");
								}				
							}
							$index++;
						}while($row_kakunin = mysql_fetch_array($res_kakunin));	
					}
					else{
						$saiban_res=mb_convert_encoding("001", "SJIS", "auto");					
					}
					echo $saiban_res;
				}
					?>"
						/*readonly=true*/
						style="background: transparent; border-width: 0px; width: 600" maxlength="3">
					</TD>
				</TR>
				<TR>
					<TH class="l-cellsec">取引先名</TH>
					<TD class="l-cellodd"><input type="text" name="name"
						value="<?php 
				if(isset($_POST['name'])){
					echo $_POST['name'];
				}
				else if(array_key_exists("wishID", $_GET)){
					echo $name;
				}
						
						?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<!--!------------------------------------------------------------------------------------->
				<TR>
					<TH class="l-cellsec">代表</TH>
					<TD class="l-cellodd"><input type="text" name="owner"
						value="<?php 
				if(isset($_POST['owner'])){
					echo $_POST['owner'];
				}
				else if(array_key_exists("wishID", $_GET)){
					echo $owner;
				}
						
						?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">メール</TH>
					<TD class="l-cellodd"><input type="text" name="mail"
						value="<?php 
				if(isset($_POST['mail'])){
					echo $_POST['mail'];
				}
				else if(array_key_exists("wishID", $_GET)){
					echo $mail;
				}
						
						?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">郵便番号</TH>
					<TD class="l-cellodd"><input type="text" name="postcode"
						value="<?php 
				if(isset($_POST['postcode'])){
					echo $_POST['postcode'];
				}
				else if(array_key_exists("wishID", $_GET)){
					echo $postcode;
				}
						
						?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">住所</TH>
					<TD class="l-cellodd"><input type="text" name="address"
						value="<?php 
				if(isset($_POST['address'])){
					echo $_POST['address'];
				}
				else if(array_key_exists("wishID", $_GET)){
					echo $address;
				}
						
						?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">担当１</TH>
					<TD class="l-cellodd"><input type="text" name="manager1"
						value="<?php 
				if(isset($_POST['manager1'])){
					echo $_POST['manager1'];
				}
				else if(array_key_exists("wishID", $_GET)){
					echo $manager1;
				}
						
						?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				<TR>
					<TH class="l-cellsec">メール</TH>
					<TD class="l-cellodd"><input type="text" name="mail1"
						value="<?php 
				if(isset($_POST['mail1'])){
					echo $_POST['mail1'];
				}
				else if(array_key_exists("wishID", $_GET)){
					echo $mail1;
				}
						
						?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				
				<TR>
					<TH class="l-cellsec">担当２</TH>
					<TD class="l-cellodd"><input type="text" name="manager2"
						value="<?php 
				if(isset($_POST['manager2'])){
					echo $_POST['manager2'];
				}
				else if(array_key_exists("wishID", $_GET)){
					echo $manager2;
				}
						
						?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				
				
				<TR>
					<TH class="l-cellsec">メール２</TH>
					<TD class="l-cellodd"><input type="text" name="mail2"
						value="<?php 
				if(isset($_POST['mail2'])){
					echo $_POST['mail2'];
				}
				else if(array_key_exists("wishID", $_GET)){
					echo $mail2;
				}
						
						?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				
				<TR>
					<TH class="l-cellsec">電話番号</TH>
					<TD class="l-cellodd"><input type="text" name="tel"
						value="<?php 
				if(isset($_POST['tel'])){
					echo $_POST['tel'];
				}
				else if(array_key_exists("wishID", $_GET)){
					echo $tel;
				}
						
						?>"
						style="width: 600" /><br />
					</TD>

				</TR>
				
				<TR>
					<TH class="l-cellsec">ファクス</TH>
					<TD class="l-cellodd"><input type="text" name="fax"
						value="<?php 
				if(isset($_POST['fax'])){
					echo $_POST['fax'];
				}
				else if(array_key_exists("wishID", $_GET)){
					echo $fax;
				}
						
						?>"
						style="width: 600" /><br />
					</TD>

				</TR>
	<!-- ------------------------------------------------------------------------------------------------------------------- -->>			
			</table>
			<?php
			if ($wishDescriptionIsEmpty){
				?>
			<span class="txt-attention">取引先名を入れてください<br /> </span>
			<?php
			}
            /*20120416に追加start*/
            if ($noUniqueCode){
            ?>
            <span class="txt-attention">唯一の取引先コードを入力してください<br /> </span>
            <?php
            }
            if ($rollBack){
            ?>
            <span class="txt-attention">レコードの更新は失敗でした。もう一度手数をかけてご保存ください<br /> </span>
            <?php
            }/*end20120416に追加*/
			?>
			<BR> <input type="submit" name="saveWish" value="保存" class="m-btn" />
			<input type="submit" name="back" value="戻る" class="m-btn" />
		</div>
	</form>
</body>
</html>

