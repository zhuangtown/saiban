<?php 
session_start();
mb_language("Japanese");
if(!isset($_SESSION["user_id"])){
    header("Location: error.php");
}
 $user_id=$_SESSION["user_id"];
include_once './Includes/DBconnect.php';
mb_language("japanese");           //言語(日本語)
//mb_internal_encoding("sjis");     //内部エンコーディング(UTF-8)
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
 //DBへ接続
 $db=DBconnect();
 mysql_set_charset('sjis');
 
 $sql_toadd="SELECT `manager`,`email` FROM `auto_post`";
 $res_toadd=mysql_query($sql_toadd,$db) or die ("DB output error!");

 $sql_pw="select * FROM `user_master` WHERE user_id='".$user_id."'";
 $row_pw=mysql_query($sql_pw,$db) or die("DB output error!");
 $rew=mysql_fetch_row($row_pw);  
 
 
 $footfi = "";
if (!($footfi = file_get_contents("files/footfi.txt"))) {
    echo "ファイルが開けません。";
	}
 
 
require_once("./phpmailer/PHPMailerAutoload.php");      //ライブラリ読み込み
mb_language("japanese");
	$default_internal_encode = mb_internal_encoding();
	if($default_internal_encode != 'UTF-8'){
	  mb_internal_encoding('UTF-8');
	}
//print_r($_POST); POSTの配列を確認ために、分
$mailAdd="";
//while ($row_toadd = mysql_fetch_array($res_toadd)){
//$mailAdd=$mailAdd.$row_toadd[1];

//}
//echo $mailAdd;
//$to = "$mailAdd";         //宛先
$subject = "案件情報- シンメトリクス".date("ymd");//件名
$castex=mb_convert_encoding($_POST['case'], "UTF-8", "auto");
$castitle=mb_convert_encoding($_POST['caseName'], "UTF-8", "auto");


$from = "$user_id@symmetrix.co.jp";                 //差出人メールアドレス格納
$fromname = "$rew[2]";  
$mail = new PHPMailer();           //PHPMailerのインスタンス生成
$mail->CharSet = "iso-2022-jp";    //文字コード設定
$mail->Encoding = "8bit";          //エンコーディング

$mail->IsSMTP();                        //「SMTPサーバーを使うよ」設定
$mail->SMTPAuth = TRUE;                 //「SMTP認証を使うよ」設定
$mail->Host = 'smtp.lolipop.jp:25';    // SMTPサーバーアドレス:ポート番号
$mail->Username = "$user_id@symmetrix.co.jp";      // SMTP認証用のユーザーID
$mail->Password = "$rew[3]";  // SMTP認証用のパスワード


for($i=1;$i<=$_POST["count"];$i++){

if(isset($_POST["wk_".$i."_check"]))
{
$cascompany=mb_convert_encoding($_POST["wk_".$i."_company"], "UTF-8", "auto");
$casmanager=mb_convert_encoding($_POST["wk_".$i."_manager"], "UTF-8", "auto");
$body = $cascompany."\n".$casmanager."様\nいつもお世話になっております。株式会社シンメトリクス葛でございます。\n"."【案件名】  　：\n".$castitle."\n"."【案件詳細】 ：\n".$castex.$footfi;                //本文格納
$mail->AddAddress($_POST["wk_".$i."_check"]);
//$mail->AddAddress($to);                                                               //宛先(To)をセット
$mail->From = $from;                                                                  //差出人(From)をセット
$mail->FromName = mb_encode_mimeheader(mb_convert_encoding($fromname,"JIS","UTF-8")); //差出人(From名)をセット
$mail->Subject = mb_encode_mimeheader(mb_convert_encoding($subject,"JIS","UTF-8"));   //件名(Subject)をセット
$mail->Body  = mb_convert_encoding($body,"JIS","UTF-8");                              //本文(Body)をセット

//メールを送信
if (!$mail->Send()){
    echo("Failed to send mail. Error:".$mail->ErrorInfo);
}else{
    echo "メールは".$casmanager."へ送りました\n";
}
$mail->ClearAddresses();
  $mail->ClearAttachments();
  
}

}
?>