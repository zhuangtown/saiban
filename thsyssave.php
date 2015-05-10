   <?php
    include_once './Includes/DBconnect.php';
    $db=DBconnect();
    mysql_set_charset('sjis');
  
    if (isset($_POST['thsysck'])){
		$shz=mb_convert_encoding($_POST["shz"], "SJIS", "auto");
		$shsys="UPDATE thsys s SET s.shz='$shz' WHERE code=1";
		mysql_query($shsys, $db) or die("DB putout error");
    }
    header('Location: setsystem.php');
?>