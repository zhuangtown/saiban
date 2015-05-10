<?php
session_start();
if(!isset($_SESSION["user_id"])){
	header("Location: error.php");
}
?>
<?php include('menubar.php'); ?>
<div id="head">
        <div id="title">
			<h1></h1>
            <TABLE WIDTH="100%" BORDER=0>
                <TR ALIGN="CENTER" WIDTH="">
                    <TD WIDTH="5%"><!--<IMG SRC='img/logo.png' BORDER='0'>-->
					<TD WIDTH="65%"></TD>
					<TD ALIGN="left" HEIGHT="35" WIDTH="15%"></TD>
				</TR>
			</TABLE>
		</div>
	</div>

	<div class="list">
		<h3 align="center">
<!--			<span style="color: gray">Departmentマスタ</span>  2013/03/13改修-->
			<span style="color: darkslategray">事業部マスタ</span>
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

	include_once './Includes/DBconnect.php';
	//DBへ接続
	$db=DBconnect();
	mysql_set_charset('sjis');
	$perNumber=10; //毎ページの表示するページ数
	//$page=$_GET['page']; //当前のページ数を取る
	$count=mysql_query("select count(*) from department"); //総レコード数
	$rs=mysql_fetch_array($count);
	$totalNumber=$rs[0];
	$totalPage=ceil($totalNumber/$perNumber); //ページ数を計算する
	if (isset($_GET['page'])) {
		//$page=1;//値がない場合、１を
		$page=$_GET['page']; //当前のページ数を取る
	}
	else{
		//$page=$_GET['page']; //当前のページ数を取る
		$page=1;//値がない場合、１を
	}
	$startCount=($page-1)*$perNumber; //
	$result=mysql_query("select code,department,boss,manager1,manager2 from department order by code limit $startCount,$perNumber"); //
	?>
	<form style='padding: 0px; margin: 0px;' name="departmentMainten"
		　action="departmentMainten.php" method="GET">
		<input type="hidden" name="page" value="<?php echo $page; ?>" />
	</form>
	<div class="list">
		<table class="l-tbl">
			<col width="15%">
			<col width="70%">
			<col width="15%">
			<col width="15%">
			<TR>
				<TH class="l-cellcenter">事業部コード</TH>
				<TH class="l-cellcenter">事業部名称</TH>
				<TH class="l-cellcenter">部長</TH>
				<TH class="l-cellcenter">担当１</TH>
				<TH class="l-cellcenter">担当２</TH>
				<TH class="l-cellcenter">操作</TH>
			</TR>
			<?php
			while ($row=mysql_fetch_array($result)) {
				$wishID = $row["code"];
				?>
			<TR>
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[0]?>" readonly=true
					style="background: transparent; border-width: 0px;">
				</TD>
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[1]?>" readonly=true
					style="background: transparent; width:100;border-width: 0px; ">
				</TD>
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[2]?>" readonly=true
					style="background: transparent;width:100; border-width: 0px; ">
				</TD>
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[3]?>" readonly=true
					style="background: transparent; width:100;border-width: 0px; ">
				</TD>
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[4]?>" readonly=true
					style="background: transparent; width:100;border-width: 0px; ">
				</TD>

				<TD class="l-cellodd">
					<table class="l-tbl">
						<TD>
							<form style='padding: 0px; margin: 0px;'
								　name="departmentEditWish" action="departmentEditWish.php"
								method="GET">
								<input type="hidden" name="wishID"
									value="<?php echo $wishID; ?>" /> <input TYPE="submit"
									name="editWish" VALUE="変更" class="i-btn">
							</form>
						</TD>
						<TD>
							<form style='padding: 0px; margin: 0px;' height=0　name=
								"departmentDeleteWish" action="departmentDeleteWish.php"
								method="POST">
								<input type="hidden" name="wishID"
									value="<?php echo $wishID; ?>" /> <input TYPE="submit"
									name="deleteWish" VALUE="削除" class="i-btn">
							</form>
						</TD>
					</table></TD>
			</TR>
			<?php
			}
			?>

		</table>

		<?php
		if ($page != 1) { //
			?>
		<A href="departmentMainten.php?page=<?php echo $page - 1;?>">前のページ</A>
		<?php
		}
		if($totalPage > 1){
		    for ($i=1;$i<=$totalPage;$i++) {  //
		        if($page != $i){
		?>
		&nbsp<A href="departmentMainten.php?page=<?php echo $i;?>"><?php echo $i ;?>
		</A>&nbsp
		<?php
		        }else{
		            echo "&nbsp" . $i . "&nbsp";
		        }
		    }
		}
		if ($page<$totalPage) { //
			?>
		&nbsp<A href="departmentMainten.php?page=<?php echo $page + 1;?>">次のページ</A>
		<?php
		}
		?>

		<form name="addNewWish" action="departmentEditWish.php">
			<input type="submit" value="マスタ追加" class="m-btn" />
		</form>
	</div>
</body>
</html>
