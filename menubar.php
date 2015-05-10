<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
<meta http-equiv="Content-Style-Type" content="text/css">
<link href="css/common.css" rel="stylesheet" type="text/css">
<link href="css/table.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/demo.css" />
<link rel="stylesheet" type="text/css" href="js/menu/fixedMenu_style1.css" />
<script type="text/javascript" src="js/calendar.js" language="JavaScript"></script>
<script type="text/javascript" src="js/menu/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/menu/jquery.fixedMenu.js"></script>


        <script>
        $('document').ready(function(){
            $('.menu').fixedMenu();
        });
        </script>
<TITLE>e営業支援システム</TITLE>
</head>
<body id="doc">

  <div class="menu">
        <ul>
     <li><IMG SRC='img/logo.png' ></li>
	<li><a href="/saiban/Menu.php">ホーム</a></li>
	<li>
                <a href="#">書類作成<span class="arrow"></span></a>
                
                <ul>
                    <li><a href="quotationsaiban.php">見積書作成</a></li>
                    <li><a href="ordersaiban.php">注文書作成</a></li>
					<li><a href="accountsaiban.php">請求書作成</a></li>
					<li><a href="immature.php">注文請書作成</a></li>
                </ul>
            </li>
			
			<li>
                <a href="#">積計分析<span class="arrow"></span></a>
                
                <ul>
                    <li><a href="demo.php">見積書一覧</a></li>
                    <li><a href="ordercheck.php">注文書一覧</a></li>
                    <li><a href="accountcost.php">請求書一覧</a></li>
					<li><a href="immature.php">注文受書一覧</a></li>
                </ul>
            </li>
            <li>
                <a href="#">帳票一覧<span class="arrow"></span></a>
                
                <ul>
                    <li><a href="accountcheck.php">注文書一覧</a></li>
                </ul>
            </li>
			<li>
                <a href="#">ＰＪ管理<span class="arrow"></span></a>
                <ul>
                    <li><a href="immature.php">新規ＰＪ追加</a></li>
					<li><a href="immature.php">ＰＪ一覧</a></li>
                </ul>
            </li>
			
			<li>
                <a href="#">システム管理<span class="arrow"></span></a>
                <ul>
                    <li><a href="userMainten.php">ユーザー設定</a></li>
                    <li><a href="setsystem.php">システム設定</a></li>
                </ul>
            </li>  
			
			<li>
                <a href="#">社内情報<span class="arrow"></span></a>
                <ul>
                    <li><a href="departmentMainten.php">事業部情報</a></li>
                    <li><a href="customerMainten.php">取引先情報</a></li>
					 <li><a href="workMerberlist.php?delete=0">社員情報</a></li>
                </ul>
            </li>  
			
			<li>
                <a href="#">送信ツール<span class="arrow"></span></a>
                <ul>
                    <li><a href="autooppadd.php">送信先（案件情報）登録</a></li>
                    <li><a href="immature.php">送信先（技術者紹介）登録</a></li>
					 <li><a href="autooppsend.php">案件情報送信</a></li>
					 <li><a href="immature.php">技術者提案送信</a></li>
                </ul>
            </li>  
			<li><a href="/saiban/Login.php">ログアウト</a></li>
      
	   </ul>
    </div>
        