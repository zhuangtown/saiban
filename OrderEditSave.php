<?php
//error_reporting(E_ALL^E_NOTICE^E_WARNING);
//session_start();
mb_language("Japanese");
if(!isset($_SESSION["user_id"])){
    header("Location: error.php");
}

include_once './Includes/DBconnect.php';
//DB�֐ڑ�
$db=DBconnect();
mysql_set_charset('sjis');

//�g�����U�N�V�����J�n
$sql_transaction = "BEGIN";
$rs_transaction = mysql_query($sql_transaction, $db) or die("DB putout error1");
//order�֕ۑ�
$sql_order_save = "INSERT INTO `order`(`saibanRes`, `workName`, `workContents`, `periodStart`, `periodEnd`, `payCondition`, `workPlace`, `workCharge`, `explanation`, `buildDate`) VALUES ('".$_POST["saibanRes"]."','".$_POST["workName"]."','".$_POST["workContents"]."','".$_POST["periodStart"]."','".$_POST["periodEnd"]."','".$_POST["payCondition"]."','".$_POST["workPlace"]."','".$_POST["workCharge"]."','".$_POST["explanation"]."','".date('Y-m-d')."')";
$rs_order_save = mysql_query($sql_order_save, $db) or die("DB putout error4");
if($rs_order_save == 1){
    //work�֕ۑ�
    $sql_work_save = "";
    for($i=1;$i<=10;$i++){
     if($_POST['wk_'.$i.'_stepContents']!=null){
        $sql_work_save = "INSERT INTO `work`(`id`, `saibanRes`, `workContents`, `number`, `unitPrice`, `price`, `addunitprice`, `subtractunitprice`, `updatetime`) VALUES ('".$_POST['wk_'.$i.'_id']."','".$_POST["saibanRes"]."','".$_POST['wk_'.$i.'_stepContents']."','".$_POST['wk_'.$i.'_Number']."','".$_POST['wk_'.$i.'_unitprice']."','".$_POST['wk_'.$i.'_price']."','".$_POST['wk_'.$i.'_addunitPrice']."','".$_POST['wk_'.$i.'_subtractunitprice']."',null)";
       $rs_work_save = mysql_query($sql_work_save, $db) or die("hahahaDB putout error4");
            if($rs_work_save != 1) break;//work�ւ̕ۑ��͎��s�̏ꍇ�A�z����o��
        }
    }
    if($rs_work_save == 1) {
        //work�ւ̕ۑ��͐����̏ꍇ�A�R�~�g
        $sql_transaction = "COMMIT";
        $res_transaction = mysql_query($sql_transaction, $db) or die("DB putout error1");
    }else{
        //work�ւ̕ۑ��͎��s�̏ꍇ�A���[���o�b�N
		echo "rollbaclk";
        $sql_transaction = "ROLLBACK";
        $res_transaction = mysql_query($sql_transaction, $db) or die("DB putout error1");
    }
}else{
    //order�ւ̕ۑ��͎��s�̏ꍇ�A���[���o�b�N
    $sql_transaction = "ROLLBACK";
	echo "error";
    $res_transaction = mysql_query($sql_transaction, $db) or die("DB putout error1");
}

include("./Includes/Components/orderToPdf.php");
    orderToPdf();
?>