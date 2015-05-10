<?php
error_reporting(E_ALL ^ E_DEPRECATED);
// この2つのファイルを読み込みます
require_once '../excel/Classes/PHPExcel.php';
require_once '../excel/Classes/PHPExcel/IOFactory.php';
include_once '../Includes/DBconnect.php';
//DBへ接続
$db=DBconnect();
mysql_set_charset('sjis');
$sql_thquery="SELECT id,name,sum(moo1),sum(shz1),sum(sum1),sum(moo2),sum(shz2),sum(sum2),sum(moo3),sum(shz3),sum(sum3),sum(moo4),sum(shz4),sum(sum4),sum(moo5),sum(shz5),sum(sum5),sum(moo6),sum(shz6),sum(sum6),sum(moo7),sum(shz7),sum(sum7),sum(moo8),sum(shz8),sum(sum8),sum(moo9),sum(shz9),sum(sum9),sum(moo10),sum(shz10),sum(sum10),sum(moo11),sum(shz11),sum(sum11),sum(moo12),sum(shz12),sum(sum12) FROM thquery group by name ";
$res_thquery=mysql_query($sql_thquery,$db) or die ("DB putout error1");

$objPHPExcel = new PHPExcel();


$sheet = $objPHPExcel->setActiveSheetIndex(0);
//$sheet = $objPHPExcel->setTitle('テストシート');

$rowcount=2;

     
     $objPHPExcel->getActiveSheet()->SetCellValue('A'.'1', "id");
     $objPHPExcel->getActiveSheet()->SetCellValue('B'.'1',"会社名"); 
     $objPHPExcel->getActiveSheet()->SetCellValue('C'.'1', "1月税抜く");
	 $objPHPExcel->getActiveSheet()->SetCellValue('D'.'1', "1月税金");
	 $objPHPExcel->getActiveSheet()->SetCellValue('E'.'1', "1月税込");
	 $objPHPExcel->getActiveSheet()->SetCellValue('F'.'1', "2月税抜く");
	 $objPHPExcel->getActiveSheet()->SetCellValue('G'.'1', "2月税金");
	 $objPHPExcel->getActiveSheet()->SetCellValue('H'.'1', "2月税込");
	 $objPHPExcel->getActiveSheet()->SetCellValue('I'.'1', "3月税抜く");
	 $objPHPExcel->getActiveSheet()->SetCellValue('J'.'1', "3月税金");
	 $objPHPExcel->getActiveSheet()->SetCellValue('K'.'1', "3月税込");
	 $objPHPExcel->getActiveSheet()->SetCellValue('L'.'1', "4月税抜く");
	 $objPHPExcel->getActiveSheet()->SetCellValue('M'.'1', "4月税金");
	 $objPHPExcel->getActiveSheet()->SetCellValue('N'.'1', "4月税込");
	 $objPHPExcel->getActiveSheet()->SetCellValue('O'.'1', "5月税抜く");
	 $objPHPExcel->getActiveSheet()->SetCellValue('P'.'1', "5月税金");
	 $objPHPExcel->getActiveSheet()->SetCellValue('Q'.'1', "5月税込");
	 $objPHPExcel->getActiveSheet()->SetCellValue('R'.'1', "6月税抜く");
	 $objPHPExcel->getActiveSheet()->SetCellValue('S'.'1', "6月税金");
	 $objPHPExcel->getActiveSheet()->SetCellValue('T'.'1', "6月税込");
	 $objPHPExcel->getActiveSheet()->SetCellValue('U'.'1', "7月税抜く");
	 $objPHPExcel->getActiveSheet()->SetCellValue('V'.'1', "7月税金");
	 $objPHPExcel->getActiveSheet()->SetCellValue('W'.'1', "7月税込");
	 $objPHPExcel->getActiveSheet()->SetCellValue('X'.'1', "8月税抜く");
	 $objPHPExcel->getActiveSheet()->SetCellValue('Y'.'1', "8月税金");
	 $objPHPExcel->getActiveSheet()->SetCellValue('Z'.'1', "8月税込");
	 $objPHPExcel->getActiveSheet()->SetCellValue('AA'.'1', "9月税抜く");
	 $objPHPExcel->getActiveSheet()->SetCellValue('AB'.'1', "9月税金");
	 $objPHPExcel->getActiveSheet()->SetCellValue('AC'.'1', "9月税込");
	 $objPHPExcel->getActiveSheet()->SetCellValue('AD'.'1', "10月税抜く");
	 $objPHPExcel->getActiveSheet()->SetCellValue('AE'.'1', "10月税金");
	 $objPHPExcel->getActiveSheet()->SetCellValue('AF'.'1', "10月税込");
	 $objPHPExcel->getActiveSheet()->SetCellValue('AG'.'1', "11月税抜く");
	 $objPHPExcel->getActiveSheet()->SetCellValue('AH'.'1', "11月税金");
	 $objPHPExcel->getActiveSheet()->SetCellValue('AI'.'1', "11月税込");
	 $objPHPExcel->getActiveSheet()->SetCellValue('AJ'.'1', "12月税抜く");
	 $objPHPExcel->getActiveSheet()->SetCellValue('AK'.'1', "12月税金");
	 $objPHPExcel->getActiveSheet()->SetCellValue('AL'.'1', "12月税込");
    
	 
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
	 $objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowcount, $row[14]); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('P'.$rowcount, $row[15]); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$rowcount, $row[16]); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('R'.$rowcount, $row[17]); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('S'.$rowcount, $row[18]); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('T'.$rowcount, $row[19]); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('U'.$rowcount, $row[20]); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('V'.$rowcount, $row[21]); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('W'.$rowcount, $row[22]); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('X'.$rowcount, $row[23]); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('Y'.$rowcount, $row[24]); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('Z'.$rowcount, $row[25]); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('AA'.$rowcount, $row[26]); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('AB'.$rowcount, $row[27]); 
	 $objPHPExcel->getActiveSheet()->SetCellValue('AC'.$rowcount, $row[28]);
	 $objPHPExcel->getActiveSheet()->SetCellValue('AD'.$rowcount, $row[29]);
     $objPHPExcel->getActiveSheet()->SetCellValue('AE'.$rowcount, $row[30]);
	 $objPHPExcel->getActiveSheet()->SetCellValue('AF'.$rowcount, $row[31]);
     $objPHPExcel->getActiveSheet()->SetCellValue('AG'.$rowcount, $row[32]);
	 $objPHPExcel->getActiveSheet()->SetCellValue('AH'.$rowcount, $row[33]);
     $objPHPExcel->getActiveSheet()->SetCellValue('AI'.$rowcount, $row[34]);
	 $objPHPExcel->getActiveSheet()->SetCellValue('AJ'.$rowcount, $row[35]);
	 $objPHPExcel->getActiveSheet()->SetCellValue('AK'.$rowcount, $row[36]);
	 $objPHPExcel->getActiveSheet()->SetCellValue('AL'.$rowcount, $row[37]);
$rowcount++; 
} 

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="test.xlsx"');
header('Cache-Control: max-age=0');
$writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$writer->save('php://output');
exit;
?>








