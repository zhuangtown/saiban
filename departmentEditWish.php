<?php
session_start();
mb_language("Japanese");
if(!isset($_SESSION["user_id"])){
    header("Location: error.php");
}
include_once './Includes/DBconnect.php';
//DB�֐ڑ�
$db=DBconnect();
mysql_set_charset('sjis');
/** Initialize $wishDescriptionIsEmpty */
$wishDescriptionIsEmpty = false;
$noUniqueCode = false;//20120416�ɒǉ�
$rollBack = false;//20120416�ɒǉ�
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //�߂�̃`�F�b�N
    if (array_key_exists("back", $_POST)) {
        header('Location: departmentMainten.php');
        exit;
    }
    else if(isset($_POST['saveWish'])){
        /*20120416�ɒǉ�start*/
        //�X�V���R�[�h�̕ύX�͂Ȃ��ꍇ�݂̂Ń��j�[�N�`�F�b�N
        if (!(!empty($_POST['wishID']) && ($_POST['wishID'] == $_POST['code']))) {
            //���j�[�N�R�[�h�o���f�[�V����
            $unique_code = mb_convert_encoding($_POST['code'], "SJIS", "auto");
            $sql_uniqueCode_count = "select count(*) from department where code = '" . $unique_code . "'";
            $res_uniqueCode_count = mysql_query($sql_uniqueCode_count, $db) or die("DB putout error4");
            $row_uniqueCode_count = mysql_fetch_array($res_uniqueCode_count);
            $uniqueCode_count = $row_uniqueCode_count['count(*)'];
        }
        
        if($uniqueCode_count > 0){
            $noUniqueCode = true;/*end20120416�ɒǉ�*/
        }else if ($_POST['name'] == "") {
            $wishDescriptionIsEmpty = true;
        //}else if ($_POST['wishID'] == "") {
        }else if ($_POST['wishID'] != $_POST['code']) {//20120416�ɒǉ�
            //insert
            $insert_code=mb_convert_encoding($_POST['code'], "SJIS", "auto");
            $insert_name=mb_convert_encoding($_POST['name'], "SJIS", "auto");
            //...................................................................
            $insert_boss=mb_convert_encoding($_POST['boss'], "SJIS", "auto");
            $insert_manager1=mb_convert_encoding($_POST['manager1'], "SJIS", "auto");
            $insert_manager2=mb_convert_encoding($_POST['manager2'], "SJIS", "auto");
            //..............................................................................
            $sql_department="BEGIN";//20120416�ɒǉ�
            $res_department = mysql_query($sql_department, $db) or die("DB putout error1");//20120416�ɒǉ�
            //.......................................................................
            $sql_department="INSERT INTO department (code,department,boss,manager1,manager2,updateuser,updatetime,version) VALUES ('".$insert_code."', '".$insert_name."','".$insert_boss."','".$insert_manager1."','".$insert_manager2."', 'yin_test',CURRENT_TIMESTAMP,'1')";
            
            //.........................................................................
            $res_department = mysql_query($sql_department, $db) or die("DB putout error1");
            /*20120416�ɒǉ�start*/
            if(!empty($_POST['wishID'])){
                $sql_department = "DELETE FROM department WHERE code = '".$_POST['wishID']."'";
                $res_department = mysql_query($sql_department, $db) or die("DB putout error1");
                if(!$res_department){
                    $sql_department="ROLLBACK";
                    $res_department = mysql_query($sql_department, $db) or die("DB putout error1");
                    $rollBack = true;
                }else{
                    $sql_department="COMMIT";
                    $res_department = mysql_query($sql_department, $db) or die("DB putout error1");
                }
            }else{
                $sql_department="COMMIT";
                $res_department = mysql_query($sql_department, $db) or die("DB putout error1");
            }
            /*end20120416�ɒǉ�*/
            header('Location: departmentMainten.php');
            exit;
            //update
        } else if ($_POST['name'] != "") {
            $wishID=mb_convert_encoding($_POST['code'], "SJIS", "auto");
            $updName=mb_convert_encoding($_POST['name'], "SJIS", "auto");
            //............................................................
            $updboss=mb_convert_encoding($_POST['boss'], "SJIS", "auto");
            $updmanager1=mb_convert_encoding($_POST['manager1'], "SJIS", "auto");
            $updmanager2=mb_convert_encoding($_POST['manager2'], "SJIS", "auto");
            $sql_department = "UPDATE department SET department = '".$updName."',boss='".$updboss."',manager1='".$updmanager1."',manager2='".$updmanager2."',updatetime = CURRENT_TIMESTAMP WHERE code = ".$wishID;
            //...........................................................................
            $res_department = mysql_query($sql_department, $db) or die("DB putout error2");
            header('Location: departmentMainten.php');
            exit;
        }
    }
}
?>
<?php include('menubar.php'); ?>
<div id="head">
        <div id="title">
            <h1></h1>
<!--            <TABLE WIDTH="100%" BORDER=0 CELLSPACING=4 CELLPADDING=0>----2013/03/22���C----->
            <TABLE WIDTH="100%" BORDER=0>
                <TR ALIGN="CENTER" WIDTH="">
<!--                    <TD WIDTH="5%"><IMG SRC='img/ekintai1.gif' BORDER='0'>----2013/03/22���C----->
                    <TD WIDTH="5%"><IMG SRC='img/logo.png' BORDER='0'>
<!--                <TD WIDTH="95%"></TD>------2013/03/13���C------------------------------------->
                    <TD WIDTH="65%"></TD>
                    <TD ALIGN="left" HEIGHT="35" WIDTH="15%"></TD>
                </TR>
            </TABLE>
        </div>
    </div>

    <div class="list">
        <h3 align="center">
<!--           <span style="color: gray">Department�}�X�^</span>------2013/03/13���C------------------------------------->
            <span style="color: darkslategray">Department�}�X�^</span>
        </h3>
        <table class="l-tbl">
            <col width="20%">
            <col width="60%">
            <TR>
            </TR>

            <TR>
            </TR>

            <TR>
            </TR>
        </table>
        <BR>
    </div>
    <?php

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        //$wish = array("code" => $_POST['code'],"name" => $_POST['name']);
        //.................................................................................
        $wish = array("code" => $_POST['wishID'],"name" => $_POST['name'],"boss"=>$_POST['boss'],"manager1"=>$_POST['manager1'],"manager2"=>$_POST['manager2']);//20120416�ɒǉ�
       //..........................................................................................
    }
    //�C������ꍇ
    else if (array_key_exists("wishID", $_GET)) {
        //$sql = "SELECT department FROM department where code='".$_GET['wishID']."'";
        //.....................................................................................
        $sql = "SELECT department,code,boss,manager1,manager2 FROM department where code='".$_GET['wishID']."'";//20120416�ɒǉ�
        $res = mysql_query($sql, $db) or die("DB putout error3");
        $row_res=mysql_fetch_array($res);
        $name=$row_res[0];
        $wish = array("code" => $row_res[1], "name" => $row_res[0],"boss"=>$row_res[2],"manager1"=>$row_res[3],"manager2"=>$row_res[4]);//20120416�ɒǉ�
    }
    else
    $wish = array("code" => "", "name" => "");
    ?>
    <form name="departmentEditWish" action="departmentEditWish.php"
        method="POST">
        <div class="list">
            <table class="l-tbl">
                <col width="20%">
                <col width="60%">

                <TR>
                    <TH class="l-cellsec">���ƕ��R�[�h</TH>
                    <TD class="l-cellodd"><input type="hidden" name="wishID"
                        value="<?php echo $wish['code']; ?>" /> <input type="text"
                        name="code"
                        value="<?php 
                if(isset($_POST['code'])){
                    echo $_POST['code'];
                }
                else if(array_key_exists("wishID", $_GET)){
                    echo $_GET['wishID'];
                }
                else{
                    //�V�K�ǉ��̏ꍇ�Acode�̔Ԍv�Z    
                    $index=1;    
                    $sql_maxCount="select count(*) from department"; //�����R�[�h��
                    $res_maxCount = mysql_query($sql_maxCount, $db) or die("DB putout error4");
                    $row_maxCount = mysql_fetch_array($res_maxCount);
                                        
                    $sql_kakunin = "SELECT code FROM department order by code";
                    $res_kakunin = mysql_query($sql_kakunin, $db) or die("DB putout error5");
                    
                    if($row_kakunin = mysql_fetch_array($res_kakunin)){
                
                        do
                        {
                            $no_count=intval($row_kakunin[0]);
                            if($index<>$no_count){
                                if($index<10){
                                    $index=sprintf("00%s",$index);
                                }elseif($index>=10 & $index<=99){
                                    $index=sprintf("0%s",$index);
                                }elseif($index>=100 & $index<=999){
                                    $index=sprintf("%s",$index);
                                }
                                $saiban_res=mb_convert_encoding($index, "SJIS", "auto");
                                break;
                            }
                            else{        
                                if($index==$row_maxCount[0]){
                                    $index=$index+1;
                                    if($index<10){
                                        $index=sprintf("00%s",$index);
                                    }elseif($index>=10 & $index<=99){
                                        $index=sprintf("0%s",$index);
                                    }elseif($index>=100 & $index<=999){
                                        $index=sprintf("%s",$index);
                                    }
                                    $saiban_res=mb_convert_encoding($index, "SJIS", "auto");
                                }                
                            }
                            $index++;
                        }while($row_kakunin = mysql_fetch_array($res_kakunin));    
                    }
                    else{
                        $saiban_res=mb_convert_encoding("001", "SJIS", "auto");                    
                    }
                    echo $saiban_res;
                }
                    ?>"
                        /*readonly=true*/
                        style="background: transparent; border-width: 0px; width: 600" maxlength="3">
                    </TD>
                </TR>
                <TR>
                    <TH class="l-cellsec">���ƕ�����</TH>
                    <TD class="l-cellodd"><input type="text" name="name"
                        value="<?php 
                if(isset($_POST['name'])){
                    echo $_POST['name'];
                }
                else if(array_key_exists("wishID", $_GET)){
                    echo $name;
                }
                        
                        ?>"
                        style="width: 600" /><br />
                    </TD>

                </TR>
               <!-- 2014-10-22 -->>
               <TR>
                    <TH class="l-cellsec">����</TH>
                    <TD class="l-cellodd"><input type="text" name="boss"
                        value="<?php 
                if(isset($_POST['boss'])){
                    echo $_POST['boss'];
                }
                else if(array_key_exists("wishID", $_GET)){
                    echo $boss;
                }
                        
                        ?>"
                        style="width: 600" /><br />
                    </TD>

                </TR>
                <TR>
                    <TH class="l-cellsec">�S���P</TH>
                    <TD class="l-cellodd"><input type="text" name="manager1"
                        value="<?php 
                if(isset($_POST['manager1'])){
                    echo $_POST['manager1'];
                }
                else if(array_key_exists("wishID", $_GET)){
                    echo $manager1;
                }
                        
                        ?>"
                        style="width: 600" /><br />
                    </TD>

                </TR>
                <TR>
                    <TH class="l-cellsec">�S���Q</TH>
                    <TD class="l-cellodd"><input type="text" name="manager2"
                        value="<?php 
                if(isset($_POST['manager2'])){
                    echo $_POST['manager2'];
                }
                else if(array_key_exists("wishID", $_GET)){
                    echo $manager2;
                }
                        
                        ?>"
                        style="width: 600" /><br />
                    </TD>

                </TR>
                <!-- 2014-10-22---------------------------------------------------------------- -->>
            </table>
            <?php
            if ($wishDescriptionIsEmpty){
            ?>
            <span class="txt-attention">���q�l�������Ă�������<br /> </span>
            <?php
            }
            /*20120416�ɒǉ�start*/
            if ($noUniqueCode){
            ?>
            <span class="txt-attention">�B��̎��ƕ��R�[�h����͂��Ă�������<br /> </span>
            <?php
            }
            if ($rollBack){
            ?>
            <span class="txt-attention">���R�[�h�̍X�V�͎��s�ł����B������x�萔�������Ă��ۑ���������<br /> </span>
            <?php
            }/*end20120416�ɒǉ�*/
            ?>
            <BR> <input type="submit" name="saveWish" value="�ۑ�" class="m-btn" />
            <input type="submit" name="back" value="�߂�" class="m-btn" />
        </div>
    </form>
</body>
</html>

