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
			<TABLE WIDTH="100%" BORDER=0 CELLSPACING=4 CELLPADDING=0>
				<TR ALIGN="CENTER" WIDTH="">

					<TD WIDTH="5%"><!--<IMG SRC='img/logo.png' BORDER='0'>--></TD>

					<TD WIDTH="65%"></TD>
					<TD ALIGN="left" HEIGHT="35" WIDTH="15%"></TD>
				</TR>
			</TABLE>
		</div>
	</div>

	<div class="list">
		<h3 align="center">
<!--			<span style="color: gray">Customerマスタ</span> 2013/03/13改修-->
			<span style="color: darkslategray">取引先マスタ</span>
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
	<!--	<BR>  -->
	</div>
	<!-- 2013/03/04追加--ここから-------------------------------->
	<?php
	//2013/03/04追加--ここから------------------------------------>
	if(isset($_POST['Type'])){
		$perNumber=$_POST['Type']; //毎ページの表示するページ数
		$Number=$_POST['Type'];
	}
	else{
		$perNumber=25;
	}
	//2013/03/04追加--ここまで------------------------------------>
	?>
	<div id="disp" class="list">
<!--	<TABLE WIDTH="80" ALIGN="right" BORDER=0 CELLSPACING=4 CELLPADDING=0> 2013/03 改修-->
		<TABLE   style=" width: 80px;" ALIGN="right" BORDER=0>
			<TR>
				<TH class="l-cellcenter">コード表示</TH>
			</TR>
			<TR ALIGN="right" WIDTH="20px">
				<TD align="center">
					<form method="POST" action="customerMainten.php">
						<select name="Type" onChange="submit(this.form)">
							<option value="25">25個</option>
							<option value="50">50個</option>
							<option value="100">100個</option>
						</select>
					</form>
				</TD>
			</TR>
		</TABLE>
	</div>
	<!-- 2013/03/04追加--ここまで--------------------------------->
	<BR><BR><BR>
	<?php

	include_once './Includes/DBconnect.php';
	//DBへ接続
	$db=DBconnect();
	mysql_set_charset('sjis');
	//<!-- 2013/03/04追加--ここから-------------------------------->
	if(isset($_GET['perNumber'])){
		$perNumber=$_GET['perNumber']; //毎ページの表示するページ数
	}
	//<!-- 2013/03/04追加--ここまで--------------------------------->
	//$page=$_GET['page']; //当前のページ数を取る
	$count=mysql_query("select count(*) from customer"); //総レコード数
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
	$result=mysql_query("select code,name,owner,mail,postcode,address,manager1,mail1,manager2,mail2,tel,fax from customer limit $startCount,$perNumber"); //
	?>
	<form style='padding: 0px; margin: 0px;' name="customerMainten"
		　action="customerMainten.php" method="GET">
		<input type="hidden" name="page" value="<?php echo $page; ?>" />
	</form>
	<div class="list">
		<table class="l-tbl">
			<col width="15%">
			<col width="15%">
			<col width="15%">
			<col width="15%">
			<col width="15%">
			<col width="15%">
			<col width="15%">
			<col width="15%">
			<col width="15%">
			<col width="15%">
			<col width="15%">
			<col width="15%">
			<TR>
				<TH class="l-cellcenter">取引先コード</TH>
				<TH class="l-cellcenter">取引先名</TH>
				<TH class="l-cellcenter">代表</TH>
				<TH class="l-cellcenter">メール</TH>
				<TH class="l-cellcenter">郵便</TH>
				<TH class="l-cellcenter">住所</TH>
			    <TH class="l-cellcenter">担当１</TH>
				<TH class="l-cellcenter">メール</TH>
				<TH class="l-cellcenter">担当２</TH>
				<TH class="l-cellcenter">メール</TH>
				<TH class="l-cellcenter">電話</TH>
				<TH class="l-cellcenter">ファクス</TH>
				<TH class="l-cellcenter">操作</TH>
				
			</TR>
			<?php
			while ($row=mysql_fetch_array($result)) {
				$wishID = $row["code"];
				?>
			<TR>
			<!-- 取引先番号 -->
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[0]?>" readonly=true
					style="background: transparent; border-width: 0px;font-weight:bold;color:steelblue">
<!--				style="background: transparent; border-width: 0px">----2013/03/22改修----->
				</TD>
				<!-- 取引先名 -->
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[1]?>" readonly=true
					style="background: transparent; border-width: 0px; width: 200;font-weight:bold;color:steelblue">
<!-- 				style="background: transparent; border-width: 0px; width: 600">----2013/03/22改修----->
				</TD>
				<!-- ---------------------------------------------------------------------------------------------------- -->
				<!--代表  -->
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[2]?>" readonly=true
					style="background: transparent; border-width: 0px;width:100;font-weight:bold;color:steelblue">

				</TD>
				<!--代表メール  -->
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[3]?>" readonly=true
					style="background: transparent; border-width: 0px;width:200;font-weight:bold;color:steelblue">

				</TD>
				<!--郵便番号  -->
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[4]?>" readonly=true
					style="background: transparent; border-width: 0px;width:70;font-weight:bold;color:steelblue">

				</TD>
				<!--住所  -->
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[5]?>" readonly=true
					style="background: transparent; border-width: 0px;width:300;font-weight:bold;color:steelblue">

				</TD>
				<!-- 担当１ -->
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[6]?>" readonly=true
					style="background: transparent; border-width: 0px;width:100;font-weight:bold;color:steelblue">

				</TD>
				<!-- 担当１のメール -->
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[7]?>" readonly=true
					style="background: transparent; border-width: 0px;width:200;font-weight:bold;color:steelblue">

				</TD>
				<!--担当２  -->
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[8]?>" readonly=true
					style="background: transparent; border-width: 0px; width: 100;font-weight:bold;color:steelblue">

				</TD>
					<!-- 担当２のメール -->
				<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[9]?>" readonly=true
					style="background: transparent; border-width: 0px; width: 200;font-weight:bold;color:steelblue">

				</TD>
				<!--電話番号  -->
					<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[10]?>" readonly=true
					style="background: transparent; border-width: 0px; width: 100;font-weight:bold;color:steelblue">

				</TD>
					</TD>
				<!-- ファクス番号 -->
					<TD class="l-cellodd"><input type="text"
					value="<?php echo $row[11]?>" readonly=true
					style="background: transparent; border-width: 0px; width: 100;font-weight:bold;color:steelblue">

				</TD>
<!-- ------------------------------------------------------------------------------------------------------------------------------ -->
				<TD class="l-cellodd">
					<table class="l-tbl">
						<TD>
							<form style='padding: 0px; margin: 0px;' 　name="customerEditWish"
								action="customerEditWish.php" method="GET">
								<input type="hidden" name="wishID"
									value="<?php echo $wishID; ?>" /> <input TYPE="submit"
									name="editWish" VALUE="変更" class="i-btn">
							</form>
						</TD>
						<TD>
							<form style='padding: 0px; margin: 0px;' height=0　name=
								"customerDeleteWish" action="customerDeleteWish.php"
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
		<!-----2013/3---改修<A href="customerMainten.php?page=<?php echo $page - 1;?>">前のページ</A>-------------------->
		<A href="customerMainten.php?page=<?php echo $page - 1;?>&perNumber=<?php echo $perNumber;?>">前のページ</A>
		<?php
		}
		if($totalPage > 1){
		    for ($i=1;$i<=$totalPage;$i++) {  //
		        if($page != $i){
		?>
		<!------2013/3---改修&nbsp<A href="customerMainten.php?page=<?php echo $i;?>"><?php echo $i ;?>------------------>
		&nbsp<A href="customerMainten.php?page=<?php echo $i;?>&perNumber=<?php echo $perNumber;?>"><?php echo $i ;?>
		</A>&nbsp
		<?php
		        }else{
		            echo "&nbsp" . $i . "&nbsp";
		        }
		    }
		}
		if ($page<$totalPage) { //
			?>
		<!------2013/3---改修&nbsp<A href="customerMainten.php?page=<?php echo $page + 1;?>">次のページ</A>--------------->
		&nbsp<A href="customerMainten.php?page=<?php echo $page + 1;?>&perNumber=<?php echo $perNumber;?>">次のページ</A>
		<?php
		}
		?>

		<form name="addNewWish" action="customerEditWish.php">
			<input type="submit" value="マスタ追加" class="m-btn" />
		</form>
	</div>
</body>
</html>