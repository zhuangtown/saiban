<?php
error_reporting(E_ALL ^ E_DEPRECATED);
// この2つのファイルを読み込みます
require_once '../excel/Classes/PHPExcel.php';
require_once '../excel/Classes/PHPExcel/IOFactory.php';
include_once '../Includes/DBconnect.php';
//DBへ接続
$db=DBconnect();
mysql_set_charset('sjis');
$sql_thquery="SELECT * FROM thquery ";
$res_thquery=mysql_query($sql_thquery,$db) or die ("DB putout error1");

$objPHPExcel = new PHPExcel();


$sheet = $objPHPExcel->setActiveSheetIndex(0);
//$sheet = $objPHPExcel->setTitle('テストシート');

$rowcount=2;

     
     $objPHPExcel->getActiveSheet()->SetCellValue('A'.'1', "id");
     $objPHPExcel->getActiveSheet()->SetCellValue('B'.'1',"会社名"); 
     $objPHPExcel->getActiveSheet()->SetCellValue('C'.'1', "一月");
     $objPHPExcel->getActiveSheet()->SetCellValue('D'.'1', "二月"); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('E'.'1', "三月"); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('F'.'1', "四月"); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('G'.'1', "五月"); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('H'.'1', "六月"); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('I'.'1', "七月"); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('J'.'1', "八月"); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('K'.'1', "九月"); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('L'.'1', "十月"); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('M'.'1', "十一月"); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('N'.'1', "十二月"); 
	 
while($row = mysql_fetch_array($res_thquery)){
     
     $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowcount, $row[0]);
     $objPHPExcel->getActiveSheet()->SetCellValue('B'.$rowcount, mb_convert_encoding($row[1],"UTF-8","SJIS"));
     $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowcount, $row[2]);
     $objPHPExcel->getActiveSheet()->SetCellValue('D'.$rowcount, $row[3]); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowcount, $row[4]); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('F'.$rowcount, $row[5]); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowcount, $row[6]); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('H'.$rowcount, $row[7]); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowcount, $row[8]); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('J'.$rowcount, $row[9]); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowcount, $row[10]); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('L'.$rowcount, $row[11]); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowcount, $row[12]); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('N'.$rowcount, $row[13]); 
$rowcount++; 
} 

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="test.xlsx"');
header('Cache-Control: max-age=0');
$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$writer->save('php://output');
exit;
?>








