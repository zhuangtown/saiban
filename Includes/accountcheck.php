<?php
function validate(){
    //DB�֐ڑ�
    include_once './Includes/DBconnect.php';
    $db=DBconnect();
    mysql_set_charset('sjis');
    /******�o���f�[�V����START******/
    $errorMsgs = "";
    //�K�{����
   $orderNoEmpty_array = array(
        'workName' => '�Ɩ�����',
        'workContents' => '��Ɠ��e',
        'periodStart' => '���ԁi�J�n�j',
        'periodEnd' => '���ԁi�I���j',
        'payCondition' => '�x������',
        'workPlace' => '��Əꏊ',
        'workCharge' => '��ƒS��'
    );
    $workNoEmpty_array = array(
        '_subtracttime' => '���Ǝ��ԉ���',
        '_addtime' => '���Ǝ��ԏ��',
        '_unitPrice' => '��P��',
        '_addunitprice' => '���ߒP��',
		'_subtractunitprice' => '�T���P��',
		'_time' => '���ۉғ�����',
    );
    //order�e�[�u���̍��ڂ̃G���[���b�Z�[�W
    foreach($orderNoEmpty_array as $key => $value){
        if(!$_POST[$key]){
            $errorMsgs .= $value . "����͂��Ă��������B<BR>";
        }
    }
  /*���ԓ��͂̃G���[���b�Z�W�[
    //if (isset($_POST['periodStart'])){
    //	if(!(preg_match("|\d{4}\/\d{2}\/\d{2}|", $_POST['periodStart']))) {
	//	    $errorMsgs .= "���Ԃ̊J�n����YYYY/MM/DD�`���œ��͂��Ă��������B";
	  //  }
var_dump($_POST['periodStart']);
    }
    if (isset($_POST['periodEnd'])&&!(preg_match("|\d{4}\/\d{2}\/\d{2}|", $_POST['periodEnd']))) {
	    $errorMsgs .= "���Ԃ̏I������YYYY/YY/DD�`���œ��͂��Ă��������B";
    }
    */

    //work�e�[�u���̍��ڂ̃G���[���b�Z�[�W

   
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
                    $errorMsgs .= $key . "�s�ڂ�" . $emptyValue . "����͂��Ă��������B<BR>";
                }
            }
        }
    }
    //�����`�F�b�N
	/*
    $workNum_array = array(
        '_number' => '����(�l��)',
        '_unitPrice' => '�P��(�~)',
        //'_price' => '���z(�~)',
       // '_addPrice' => '�ǉ��P��(�~)',
       // '_subtractPrice' => '�T���P��(�~)'
    );
    foreach ($wkCountArr as $key){
        if($_POST["wk_".$key."_stepContents"] || ($key == 1)){
            foreach($workNum_array as $numKey => $numValue){
                if(!preg_match('/^[0-9]*$/', $_POST["wk_".$key.$numKey])){
                    $errorMsgs .= $key . "�s�ڂ�" . $numValue . "�𔼊p�����œ��͂��Ă��������B<BR>";
                }
            }
        }
    }*/
    //�����ԍ����j�b�N
    $unique_saibanRes = mb_convert_encoding($_POST['saibanRes'], "SJIS", "auto");
    $sql_uniqueSaibanRes_count = "select count(*) from `order` where saibanRes = '" . $unique_saibanRes . "'";
    $res_uniqueSaibanRes_count = mysql_query($sql_uniqueSaibanRes_count, $db) or die("DB putout error4");
    $row_uniqueSaibanRes_count = mysql_fetch_array($res_uniqueSaibanRes_count);
    $uniqueSaibanRes_count = $row_uniqueSaibanRes_count['count(*)'];
    if($uniqueSaibanRes_count > 0){
        $errorMsgs .= "�B�ꔭ���ԍ��ł͂���܂���B<BR>";
    }
    //����
    if(strtotime($_POST['periodStart']) > strtotime($_POST['periodEnd'])){
        $errorMsgs .= "���Ԃ̏I�����͊J�n�����傫���悤�ɓ��͂��Ă��������B";
    }
    /******�o���f�[�V����END******/
    return $errorMsgs;
}
?>