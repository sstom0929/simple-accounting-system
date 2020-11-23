<!DOCTYPE html>
<html>
<head>
	<title>Setup</title>
	<style type="text/css">
		html{
			background-color: #f2f2f2;
		}
		body{
			font-family: Microsoft JhengHei;
		}
		.setup{
			padding-top: 80px;
			text-align: center;
			margin: auto;
		}
		table{
			text-align: center;
		}
	</style>
</head>
<body>
	<div class="setup">
		<form action="setupConfirm.php" method="POST">
			<h1>網站設定</h1>
			資料庫使用者帳號:&nbsp;&nbsp;<input type="text" name="dbUsername" required><br><br>
			資料庫使用者密碼:&nbsp;&nbsp;<input type="text" name="dbPassword" required><br><br>
			新建之資料庫名稱:&nbsp;&nbsp;<input type="text" name="dbName" required><br><br>
			<input type="submit" name="submit" value="確認">
		</form>
	</div>
</body>
</html>