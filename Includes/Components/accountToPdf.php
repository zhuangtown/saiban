<?php
/*
入力画面のデータをHtmlテンプレートに取り入れてPDFファイルとして出力する
*/

function orderToPdf(){
    //mpdfライブラリを読み込む
    include("./Includes/MPDF54/mpdf.php");
    $mpdf=new mPDF('ja', 'A4');
    //DB接続
    if (!($db=mysql_connect("localhost","root",""))) {
        exit('DB connect NG');
    }
    $con = mysql_select_db("syman",$db);
    if(!$con){
        die("DB connect NG");
    }
    mysql_set_charset('sjis');
    /******注文書htmlファイルの作成START******/
    $wkCountArr = array();
    $orderTemplate = "";
    //テンプレート読み込む
    if(!$orderTemplate = file_get_contents("./files/orderTemplate.html")){
        echo "テンプレートの読み込みは失敗です。";
        exit;
    }
	
    
    $sumprice="";
    $kzh="";
    $sumpricez="";
    $shz="";
    
    //setsysテープルがら---------------------------これは会社の情報へ取り替え----------------------------------------------------------
    $sql_setsys="SELECT  `name`,`postcode`,`address`,`tel`,`fax` FROM `setsys` WHERE code=1";
    $res_setsys=mysql_query($sql_setsys,$db) or die ("DB putouterror setsys");
    $row_setsys=mysql_fetch_array($res_setsys);
    $orderTemplate = preg_replace('/{\$' . Sname . '}/',$row_setsys[0], $orderTemplate);
    $orderTemplate = preg_replace('/{\$' . Spostcode . '}/',$row_setsys[1], $orderTemplate);
    $orderTemplate = preg_replace('/{\$' . Saddress1 . '}/',$row_setsys[2], $orderTemplate);
    $orderTemplate = preg_replace('/{\$' . Stel . '}/',$row_setsys[3], $orderTemplate);
    $orderTemplate = preg_replace('/{\$' . Sfax . '}/',$row_setsys[4], $orderTemplate);
    
	//customerテーブルから--------------------------これは相手の会社名へ取り替え-----2014-10-16修正--------------------------------------
	$rest=substr($_POST["saibanRes"],8,3);
	$sql_filema="SELECT `name` FROM `customer` WHERE `code` ='". $rest."'";
	$res_filema=mysql_query($sql_filema, $db) or die ("DB putout error02");
	$row_filema=mysql_result($res_filema,0);
	//$sql_customer="SELECT `name` FROM `customer` WHERE `code` ='".$row_filema ."'";
	//$res_customer=mysql_query($sql_customer,$db) or die ("DB putout error03");
	//$row_customer=mysql_result($res_customer,0);
	
	
	
	
	//customeテーブルの入力データへ取替え
  
            $orderTemplate = preg_replace('/{\%%' . kaisyame . '%}/',$row_filema."&#12288;&#12288;御中", $orderTemplate);

  //-------------------------------------------------この中のコードは2014-10-16に増加します---------------------------------------------------
   
    //orderテーブルから
    $sql_order = "SELECT `saibanRes`,`workName`,`workContents`,`periodStart`,`periodEnd`,`payCondition`,`workPlace`,`workCharge`,`explanation`,`buildDate` FROM `order` WHERE `saibanRes`  ='".$_POST["saibanRes"]."'";
    $res_order = mysql_query($sql_order, $db) or die("DB putout topdf");
    
    //orderテーブルの入力データへ取替え
    
    while ($row_order = mysql_fetch_array($res_order,MYSQL_ASSOC)){
	    $ymd=explode('-',$row_order["buildDate"]);
        $y=$ymd[0];
        $m=$ymd[1];
        $d=$ymd[2];
	
    	$orderTemplate=preg_replace('/{##'.saibanRes.'}/', $row_order["saibanRes"], $orderTemplate);
    	$orderTemplate=preg_replace('/{##'.workName.'}/', $row_order["workName"], $orderTemplate);
    	$orderTemplate=preg_replace('/{##'.workContents.'}/', $row_order["workContents"], $orderTemplate);
    	$orderTemplate=preg_replace('/{##'.periodStart.'}/', date("Y/m/d",strtotime($row_order["periodStart"])), $orderTemplate);
    	$orderTemplate=preg_replace('/{##'.periodEnd.'}/', date("Y/m/d",strtotime($row_order["periodEnd"])), $orderTemplate);
    	$orderTemplate=preg_replace('/{##'.payCondition.'}/', $row_order["payCondition"], $orderTemplate);
    	$orderTemplate=preg_replace('/{##'.workPlace.'}/', $row_order["workPlace"], $orderTemplate);
    	$orderTemplate=preg_replace('/{##'.workCharge.'}/', $row_order["workCharge"], $orderTemplate);
    	$orderTemplate=preg_replace('/{##'.explanation.'}/', $row_order["explanation"], $orderTemplate);
    	$build_date=$y.'年'.$m.'月'.$d.'日';
    	$orderTemplate=preg_replace('/{##'.buildDate.'}/',$build_date, $orderTemplate);
    }
    //workテーブルから
   $sql_work = "SELECT `id`,`stepContents`,`subtracttime`,`addtime`, `time`,`unitPrice`,`addPrice`,`trance` FROM `accountwork` Where `saibanRes`='" . $_POST["saibanRes"] . "' ORDER BY `id`";
    $res_work = mysql_query($sql_work, $db) or die("DB putout work error4");
    //workテーブルの入力データへ取替え
    $listTpl = "";
    if(strstr($orderTemplate, "{!") && strstr($orderTemplate, "!}")){
        $listTplContents = "";
        $listTpl = substr($orderTemplate, strpos($orderTemplate, "{!") + 2, strpos($orderTemplate, "!}") - strpos($orderTemplate, "{!") - 2);
        while ($row_work = mysql_fetch_array($res_work, MYSQL_ASSOC)) {
                $listTplTr = $listTpl;
                $listTplTr = preg_replace('/{\$id}/', $row_work["id"], $listTplTr);
                $listTplTr = preg_replace('/{\$stepContents}/', $row_work["stepContents"], $listTplTr);
                $listTplTr = preg_replace('/{\$subtracttime}/',$row_work["subtracttime"], $listTplTr);
                $listTplTr = preg_replace('/{\$addtime}/', $row_work["addtime"], $listTplTr);
                $listTplTr = preg_replace('/{\$time}/', $row_work["time"], $listTplTr);
                $listTplTr = preg_replace('/{\$unitprice}/', number_format($row_work["unitPrice"]), $listTplTr);
                $listTplTr = preg_replace('/{\$addprice}/', number_format($row_work["addPrice"]), $listTplTr);
                $listTplTr = preg_replace('/{\$trance}/', number_format($row_work["trance"]), $listTplTr);
                $sumprice=$sumprice+$row_work["unitPrice"]+$row_work["addPrice"];
                $kzh=$kzh+$row_work["trance"];
                $shz=$sumprice*0.08;
                $sumpricez=$sumprice+$shz+$kzh;
                $listTplContents .= $listTplTr;
        }
        
        //.................................................................................................................
      
        $orderTemplate = preg_replace('/{\&&' . sumprice . '&}/',number_format($sumprice), $orderTemplate);
        $orderTemplate = preg_replace('/{\&&' . shz . '&}/',number_format($shz), $orderTemplate);
        $orderTemplate = preg_replace('/{\&&' . trance . '&}/',number_format($kzh), $orderTemplate);
        $orderTemplate = preg_replace('/{\&&' . sumpricez . '&}/',number_format($sumpricez), $orderTemplate);
       
      
        
    //    次の文はhtmlテンプレートの｛！！｝内の内容は取り替えの対像とういうこと。
        $orderTemplate = substr($orderTemplate, 0, strpos($orderTemplate, "{!")) . $listTplContents . substr($orderTemplate, strpos($orderTemplate, "!}") + 2);
    }
    /******注文書htmlファイルの作成END******/
    //print_r($orderTemplate);
    $mpdf= new mPDF('ja', 'A4');
    // これがないと "mPDF error: HTML contains invalid UTF-8 character(s)" となる。なんでやねん
    $mpdf->ignore_invalid_utf8 = true;
    // 第2引数の 1 は　headerCSS only　とのこと
    //$mpdf->WriteHTML(File::get(public_path() . '/assets/h2/css/pdf.css'), 1);
    // 第2引数の 0 は default とのこと(省略可能)
   // $mpdf->WriteHTML(View::make('pdf'), 0);
   // $path                      = storage_path() . '/mpdf.pdf';
  //  $mpdf->Output($path);
    //return Response::download($path, 'mpdf.pdf', ['Content-Type: application/pdf']);
    
    $mpdf->WriteHTML($orderTemplate);
    $mpdf->Output("pdf_file/$_POST[saibanRes].pdf");
    $mpdf->Output();
    exit;
}
?>