<?php
//error_reporting(E_ALL^E_NOTICE^E_WARNING);
session_start();
mb_language("Japanese");
if(!isset($_SESSION["user_id"])){
    header("Location: error.php");
}
header('Cache-Control:no-cache');
include_once './Includes/DBconnect.php';
//DB‚ÖÚ‘±
$db=DBconnect();
mysql_set_charset('sjis');
    for($i=1;$i<=10;$i++){
    if(($_POST['wk_'.$i.'_company'])!=""){
	$company=mb_convert_encoding($_POST['wk_'.$i.'_company'],"SJIS", "auto");
 $manager=mb_convert_encoding($_POST['wk_'.$i.'_manager'],"SJIS", "auto");
 $email=mb_convert_encoding($_POST['wk_'.$i.'_email'],"SJIS", "auto");
 $zip_code=mb_convert_encoding($_POST['wk_'.$i.'_zip_code'],"SJIS", "auto");
 $position=mb_convert_encoding($_POST['wk_'.$i.'_position'],"SJIS", "auto");
 $address=mb_convert_encoding($_POST['wk_'.$i.'_address'],"SJIS", "auto");
 $tel=mb_convert_encoding($_POST['wk_'.$i.'_tel'],"SJIS", "auto");
 $mobile=mb_convert_encoding($_POST['wk_'.$i.'_mobile'],"SJIS", "auto");
 $other=mb_convert_encoding($_POST['wk_'.$i.'_other'],"SJIS", "auto");
 
 $usersql = "INSERT INTO `auto_post`(`company`, `manager`, `email`, `zip_code`, `position`, `address`, `tel`, `mobile`, `other`) 
			VALUES ('$company','$manager','$email','$zip_code','$position','$address','$tel','$mobile','$other')";
    $sql_post_save = mysql_query ( $usersql, $db ) or die ( "DB connect die!" );
 }
    }

    
header("Location: autooppadd.php");
  
?>