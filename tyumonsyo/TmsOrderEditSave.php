<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);
session_start();
mb_language("Japanese");
if(!isset($_SESSION["user_id"])){
    header("Location: error.php");
}

include_once './Includes/DBconnect.php';
include_once 'TmsOrderFormat.php';
//DBへ接続
$db=DBconnect();
mysql_set_charset('sjis');

//トランザクション開始
$sql_transaction = "BEGIN";
$rs_transaction = mysql_query($sql_transaction, $db) or die("DB putout error1");
//orderへ保存
echo $_POST["payCondition"];
echo $_POST["explanation"];
$sql_order_save = "INSERT INTO `order`(`saibanRes`, `workName`, `workContents`, `periodStart`, `periodEnd`, `payCondition`, `workPlace`, `workCharge`, `explanation`, `buildDate`) VALUES ('".$_POST["saibanRes"]."','".$_POST["workName"]."','".$_POST["workContents"]."','".$_POST["periodStart"]."','".$_POST["periodEnd"]."','".$_POST["payCondition"]."','".$_POST["workPlace"]."','".$_POST["workCharge"]."','".$_POST["explanation"]."','".date('Y-m-d')."')";
$rs_order_save = mysql_query($sql_order_save, $db) or die("DB putout error4");
if($rs_order_save == 1){
    //workへ保存
    $sql_work_save = "";
    for($i=1;$i<=10;$i++){
    if(isset($_POST['wk_'.$i.'_stepContents'])){
            $addPrice = null;
            $addtime=null;
            $time=null;
            $subtracttime=null;
            $trance=null;
            $addunitprice=null;
            $subtractunitprice=null;
            $price=$_POST['wk_'.$i.'_number']* $_POST['wk_'.$i.'_unitPrice'];
            echo "price".$price;
            if(isset($_POST['wk_'.$i.'_addtime'])){
            	$addtime=$_POST['wk_'.$i.'_addtime'];
            	$addunitprice=floor(($_POST['wk_'.$i.'_unitPrice']/$_POST['wk_'.$i.'_addtime'])/10)*10;
            	echo '$unitprice='.$_POST['wk_'.$i.'_unitPrice'];
            	echo '$addunitprice= '.$addunitprice;
            	echo '$addtime='.$addtime;
            }
            /*if(isset($_POST['wk_'.$i.'_time'])){
            	$time=$_POST['wk_'.$i.'_time'];
            	echo "3".$time;
            }*/
            if(isset($_POST['wk_'.$i.'_subtracttime'])){
            	$subtracttime=$_POST['wk_'.$i.'_subtracttime'];
            	$subtractunitprice=ceil(($_POST['wk_'.$i.'_unitPrice']/$_POST['wk_'.$i.'_subtracttime'])/10)*10;
            	echo '$subtractunitprice= '.$subtractunitprice;
            	echo '$subtracttime='.$subtracttime;
            }
        
            $sql_work_save = "INSERT INTO `work`(`id`, `saibanRes`, `workContents`, `number`, `unitPrice`, `price`, `addPrice`, `addtime`, `time`, `subtracttime`, `trance`, `addunitprice`,`subtractunitprice`,`updatetime`) VALUES ('".$_POST['wk_'.$i.'_id']."','".$_POST["saibanRes"]."','".$_POST['wk_'.$i.'_stepContents']."','".$_POST['wk_'.$i.'_number']."','".$_POST['wk_'.$i.'_unitPrice']."','".$price."','null','".$addtime."','null','".$subtracttime."','null','".$addunitprice."','".$subtractunitprice."',null)";
            $rs_work_save = mysql_query($sql_work_save, $db) or die("hahahaDB putout error4");
            if($rs_work_save != 1) break;//workへの保存は失敗の場合、循環から出る
        }
    }
    if($rs_work_save == 1) {
        //workへの保存は成功の場合、コミト
        $sql_transaction = "COMMIT";
        $res_transaction = mysql_query($sql_transaction, $db) or die("DB putout error1");
    }else{
        //workへの保存は失敗の場合、ロールバック
        $sql_transaction = "ROLLBACK";
        $res_transaction = mysql_query($sql_transaction, $db) or die("DB putout error1");
    }
}else{
    //orderへの保存は失敗の場合、ロールバック
    $sql_transaction = "ROLLBACK";
    $res_transaction = mysql_query($sql_transaction, $db) or die("DB putout error1");
}

header("Location:TmsOrderEditFinish.php?saibanRes=".$_POST["saibanRes"]);
?>