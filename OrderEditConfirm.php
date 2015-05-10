<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);
//ñﬂÇÈÉ{É^ÉìÇâüÇ∑èÍçá
if(isset($_POST["edit"])){
    require('OrderEdit.php');
    exit;
}
//ï€ë∂É{É^ÉìÇâüÇ∑èÍçá
if(isset($_POST["save"])){
    require('OrderEditSave.php');
    exit;
}
include_once 'OrderFormat.php';

header('Cache-Control:no-cache');
?>
<?php include('menubar.php'); ?>
<div id="head">
        <div id="title">
            <h1></h1>
            <TABLE WIDTH="100%" BORDER=0 CELLSPACING=4 CELLPADDING=0>
                <TR ALIGN="CENTER" WIDTH="">
                    <TD WIDTH="5%"><IMG SRC='img/logo.png' BORDER='0'>
                    </TD>
                    <TD WIDTH="95%"></TD>
                    <TD ALIGN="left" HEIGHT="35" WIDTH="15%">
                    </TD>
                </TR>
            </TABLE>
        </div>
    </div>
    <form action=OrderEditConfirm.php method=post name=order>
        <div class="list">
            <h3 align="center">
                <span style="color: gray"></span>
            </h3>
            <?php 
            if(isset($errorMsgs))echo $errorMsgs;
            ?>
            <table class="l-tbl">
                <col width="20%">
                <col width="60%">
                <TR>
                    <TH class="l-cellsec">î≠íçî‘çÜ</TH>
                    <TD class="l-cellodd">
                    <?php if(isset($_POST['saibanRes'])){echo $_POST['saibanRes'];}?>
                    <input type="hidden" name="saibanRes" value="<?php echo $_POST['saibanRes']?>">
                    </TD>
                </TR>
                <TR>
                    <TH class="l-cellsec">ã∆ñ±ñºèÃ</TH>
                    <TD class="l-cellodd">
                    <?php if(isset($_POST['workName'])){echo $_POST['workName'];}?>
                    <input type="hidden" name="workName" value="<?php echo $_POST['workName']?>">
                    </TD>
                </TR>
                <TR>
                    <TH class="l-cellsec">çÏã∆ì‡óe</TH>
                    <TD class="l-cellodd">
                    <?php if(isset($_POST['workContents'])){echo $_POST['workContents'];}?>
                    <input type="hidden" name="workContents" value="<?php echo $_POST['workContents']?>">
                    </TD>
                </TR>
                <TR>
                    <TH class="l-cellsec">ä˙ä‘</TH>
                    <TD class="l-cellodd">
                    <?php if(isset($_POST['periodStart'])){echo $_POST['periodStart'];}?>
                    Å`
                    <?if(isset($_POST['periodEnd'])){echo $_POST['periodEnd'];}?>
                    <input type="hidden" name="periodStart" value="<?php echo $_POST['periodStart']?>">
                    <input type="hidden" name="periodEnd" value="<?php echo $_POST['periodEnd']?>">
                    </TD>
                </TR>
                <TR>
                    <TH class="l-cellsec">éxï•èåè</TH>
                    <TD class="l-cellodd">
                    <?php if(isset($_POST['payCondition'])){echo $_POST['payCondition'];}?>
                    <input type="hidden" name="payCondition" value="<?php echo $_POST['payCondition']?>">
                    </TD>
                </TR>
                <TR>
                    <TH class="l-cellsec">çÏã∆èÍèä</TH>
                    <TD class="l-cellodd">
                    <?php if(isset($_POST['workPlace'])){echo $_POST['workPlace'];}?>
                    <input type="hidden" name="workPlace" value="<?php echo $_POST['workPlace']?>">
                    </TD>
                </TR>
                <TR>
                    <TH class="l-cellsec">çÏã∆íSìñ</TH>
                    <TD class="l-cellodd">
                    <?php if(isset($_POST['workCharge'])){echo $_POST['workCharge'];}?>
                    <input type="hidden" name="workCharge" value="<?php if(isset($_POST['workCharge'])){echo $_POST['workCharge'];}?>">
                    </TD>
                </TR>
            </table>
        </div>
        <div class="list">
        <table class="l-tbl">
            <col width="3%">
            <col width="16%">
            <col width="9%">
            <col width="9%">
            <col width="9%">
            <col width="9%">
            <col width="9%">
            <col width="9%">
            <col width="9%">
            <col width="9%">
            <col width="9%">
            <TR>
                <TH class="l-cellcenter">No.</TH>
                <TH class="l-cellcenter">çÏã∆ì‡óe</TH>
                <TH class="l-cellcenter">êîó (êlåé)</TH>
                <TH class="l-cellcenter">íPâø(â~)</TH>
                <TH class="l-cellcenter">â“ìÆéûä‘</TH>
                <TH class="l-cellcenter">ã‡äz(â~)</TH>
                <TH class="l-cellcenter">è„å¿éûä‘ÅiHÅj</TH>
                <TH class="l-cellcenter">â∫å¿éûä‘ÅiHÅj</TH>
               <TH class="l-cellcenter">í¥âﬂíPâø(â~)</TH>
               <TH class="l-cellcenter">çTèúíPâø(â~)</TH>
				<TH class="l-cellcenter">åí îÔ(â~)</TH>
            </TR>
            <?php 
            for($i=1;$i<=10;$i++){
           
            		
            ?>
            <TR>
                <TD   class="l-cellodd">
                <?php if($_POST['wk_'.$i.'_id']){echo $_POST['wk_'.$i.'_id'];}?>
                <?php if($_POST['wk_'.$i.'_id']){?>
                <input  type="hidden" name="wk_<?php echo $i?>_id" value="<?php echo $_POST['wk_'.$i.'_id']?>" >
                <?php }?>
                </TD>
                <TD   class="l-cellodd">
                <?php if($_POST['wk_'.$i.'_stepContents']){echo $_POST['wk_'.$i.'_stepContents'];}?>
                <?php if($_POST['wk_'.$i.'_stepContents']){?>
                    <input type="hidden" name="wk_<?php echo $i?>_stepContents" value="<?php echo $_POST['wk_'.$i.'_stepContents']?>">
                <?php }?>
                </TD>
                <TD class="l-celloddh">
                <?php if($_POST['wk_'.$i.'_number']){echo $_POST['wk_'.$i.'_number'];}?>
                <?php if($_POST['wk_'.$i.'_number']){?>
                    <input type="hidden" name="wk_<?php echo $i?>_number" value="<?php echo $_POST['wk_'.$i.'_number']?>">
                <?php }?>
                </TD>
                <TD class="l-celloddk">
                <?php if($_POST['wk_'.$i.'_unitPrice']){echo number_format($_POST['wk_'.$i.'_unitPrice']);}?>
                <?php if($_POST['wk_'.$i.'_unitPrice']){?>
                    <input type="hidden" name="wk_<?php echo $i?>_unitPrice" value="<?php echo $_POST['wk_'.$i.'_unitPrice']?>">
                <?php }?>
                </TD>
                <TD class="l-celloddh">
                <?php if($_POST['wk_'.$i.'_time']){echo $_POST['wk_'.$i.'_time'];}?>
                <?php if($_POST['wk_'.$i.'_time']){?>
                <input type="hidden" name="wk_<?php echo $i?>_time" value="<?php echo $_POST['wk_'.$i.'_time']?>">
                <?php }?>
                </TD>
                <TD class="l-celloddk">
                <?php echo ($_POST['wk_'.$i.'_stepContents']!="")?number_format($_POST['wk_'.$i.'_number']*$_POST['wk_'.$i.'_unitPrice']):null;?>
                <?php //{?>
                    <input type="hidden" name="wk_<?php echo $i?>_price" value="<?php echo ($_POST['wk_'.$i.'_stepContents']!="")?number_format($_POST['wk_'.$i.'_number']*$_POST['wk_'.$i.'_unitPrice']):null;?>">
                <?php //}?>
                </TD>
                <TD class="l-celloddh">
                <?php if($_POST['wk_'.$i.'_addtime']){echo $_POST['wk_'.$i.'_addtime'];}?>
                <?php if($_POST['wk_'.$i.'_addtime']){?>
                <input type="hidden" name="wk_<?php echo $i?>_addtime" value="<?php echo $_POST['wk_'.$i.'_addtime']?>">
                <?php }?>
                </TD>
                <TD class="l-celloddh">
                <?php if($_POST['wk_'.$i.'_subtracttime']){echo $_POST['wk_'.$i.'_subtracttime'];}?>
                <?php if($_POST['wk_'.$i.'_subtracttime']){?>
                <input type="hidden" name="wk_<?php echo $i?>_subtracttime" value="<?php echo $_POST['wk_'.$i.'_subtracttime']?>">
                <?php }?>
                </TD>
                <TD class="l-sellodd">
                <input type="text" name="wk_<?php echo $i ?>_oldaddunitprice" value="<?php echo ($_POST['wk_'.$i.'_time']>$_POST['wk_'.$i.'_addtime'])?number_format(floor(($_POST['wk_'.$i.'_unitPrice']/$_POST['wk_'.$i.'_addtime'])/10)*10):null;?>"style="text-align: right">
                 <input type="hidden" name="wk_<?php echo $i ?>_addunitprice" value="<?php echo ${'wk_'.$i.'_oldaddunitprice'};?>"> 
                </TD>
                <TD class="l-sellodd">
                <input type="text" name="wk_<?php echo $i ?>_oldsubtractunitprice" value="<?php echo ($_POST['wk_'.$i.'_time']<$_POST['wk_'.$i.'_subtracttime'])?number_format(ceil(($_POST['wk_'.$i.'_unitPrice']/$_POST['wk_'.$i.'_subtracttime'])/10)*10):null; ?>" style="text-align:right">
                <input type="hidden" name="wk_<?php echo $i ?>_subtractunitprice" value="<?php echo ${'wk_'.$i.'_oldsubtractunitprice'};?>"> 
              
             
                <TD class="l-celloddk">
                <?php if($_POST['wk_'.$i.'_trance']){echo number_format($_POST['wk_'.$i.'_trance']);}?>
                <?php if($_POST['wk_'.$i.'_trance']){?>
                <input type="hidden" name="wk_<?php echo $i?>_trance" value="<?php echo $_POST['wk_'.$i.'_trance']?>">
                <?php }?>
                </TD>
            </TR>
            <?php 
            }
            ?>
        </table>
        <table class="l-tbl">
            <TR>
                <TD class="l-cellodd">
                     <?php echo nl2br($_POST['explanation']);?>
                    <input type="hidden" name="explanation" value="<?php echo $_POST['explanation'];?>">
                </TD>
            </TR>
            <TR>
                <TD align=center><br>
                    <input type="submit" name="save" value="ï€ë∂">
                    <input type="submit" name="edit" value="ñﬂÇÈ">
                </TD>
            </TR>
        </table>
    </div>
    </form>
</body>
</html>