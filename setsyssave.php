   <?php
    include_once './Includes/DBconnect.php';
    $db=DBconnect();
    mysql_set_charset('sjis');
   
    if (($_POST['sysck'])){
    	

$postcode=mb_convert_encoding($_POST["postcode"], "SJIS", "auto");
$address=mb_convert_encoding($_POST["address"], "SJIS", "auto");
$tel=mb_convert_encoding($_POST["tel"], "SJIS", "auto");
$fax=mb_convert_encoding($_POST["fax"], "SJIS", "auto");
$setsys="UPDATE setsys s SET s.postcode='$postcode',s.address='$address',s.tel='$tel',s.fax='$fax' WHERE code=1";
mysql_query($setsys, $db) or die("DB putout error");
    }
    header('Location: setsystem.php');
?>