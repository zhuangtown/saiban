<?php
function validate(){
    //DBへ接続
    include_once './Includes/DBconnect.php';
    $db=DBconnect();
    mysql_set_charset('sjis');
    /******バリデーションSTART******/
    $errorMsgs = "";
    //必須項目
   $orderNoEmpty_array = array(
        'workName' => '業務名称',
        'workContents' => '作業内容',
        'periodStart' => '期間（開始）',
        'periodEnd' => '期間（終了）',
        'payCondition' => '支払条件',
        'workPlace' => '作業場所',
        'workCharge' => '作業担当'
    );
    $workNoEmpty_array = array(
        '_subtracttime' => '基準作業時間下限',
        '_addtime' => '基準作業時間上限',
        '_unitPrice' => '基準単価',
        '_addunitprice' => '超過単価',
		'_subtractunitprice' => '控除単価',
		'_time' => '実際稼動時間',
    );
    //orderテーブルの項目のエラーメッセージ
    foreach($orderNoEmpty_array as $key => $value){
        if(!$_POST[$key]){
            $errorMsgs .= $value . "を入力してください。<BR>";
        }
    }
  /*期間入力のエラーメッセジー
    //if (isset($_POST['periodStart'])){
    //	if(!(preg_match("|\d{4}\/\d{2}\/\d{2}|", $_POST['periodStart']))) {
	//	    $errorMsgs .= "期間の開始日はYYYY/MM/DD形式で入力してください。";
	  //  }
var_dump($_POST['periodStart']);
    }
    if (isset($_POST['periodEnd'])&&!(preg_match("|\d{4}\/\d{2}\/\d{2}|", $_POST['periodEnd']))) {
	    $errorMsgs .= "期間の終了日はYYYY/YY/DD形式で入力してください。";
    }
    */

    //workテーブルの項目のエラーメッセージ

   
    $wkCountArr = array();
    foreach ($_POST as $name => $value){
        if(substr($name, 0, 2) == "wk"){
            $wkNmArr = explode('_', $name);
            $wkCountArr[$wkNmArr['1']] = $wkNmArr['1'];
        }
    } 
    foreach ($wkCountArr as $key){
        if($_POST["wk_".$key."_stepContents"] || ($key == 1)){
            foreach($workNoEmpty_array as $emptyKey => $emptyValue){
                if(!$_POST["wk_".$key.$emptyKey]){
                    $errorMsgs .= $key . "行目の" . $emptyValue . "を入力してください。<BR>";
                }
            }
        }
    }
    //数字チェック
	/*
    $workNum_array = array(
        '_number' => '数量(人月)',
        '_unitPrice' => '単価(円)',
        //'_price' => '金額(円)',
       // '_addPrice' => '追加単価(円)',
       // '_subtractPrice' => '控除単金(円)'
    );
    foreach ($wkCountArr as $key){
        if($_POST["wk_".$key."_stepContents"] || ($key == 1)){
            foreach($workNum_array as $numKey => $numValue){
                if(!preg_match('/^[0-9]*$/', $_POST["wk_".$key.$numKey])){
                    $errorMsgs .= $key . "行目の" . $numValue . "を半角数字で入力してください。<BR>";
                }
            }
        }
    }*/
    //発注番号ユニック
    $unique_saibanRes = mb_convert_encoding($_POST['saibanRes'], "SJIS", "auto");
    $sql_uniqueSaibanRes_count = "select count(*) from `order` where saibanRes = '" . $unique_saibanRes . "'";
    $res_uniqueSaibanRes_count = mysql_query($sql_uniqueSaibanRes_count, $db) or die("DB putout error4");
    $row_uniqueSaibanRes_count = mysql_fetch_array($res_uniqueSaibanRes_count);
    $uniqueSaibanRes_count = $row_uniqueSaibanRes_count['count(*)'];
    if($uniqueSaibanRes_count > 0){
        $errorMsgs .= "唯一発注番号ではありません。<BR>";
    }
    //期間
    if(strtotime($_POST['periodStart']) > strtotime($_POST['periodEnd'])){
        $errorMsgs .= "期間の終了日は開始日より大きいように入力してください。";
    }
    /******バリデーションEND******/
    return $errorMsgs;
}
?>