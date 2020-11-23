<?php
	function returnToSetup(){
		echo '<script>document.location.href = "setup.php";</script>';
	}
	if(isset($_POST['submit'])){
		$db = mysqli_connect('localhost', $_POST['dbUsername'], $_POST['dbPassword']);
		if(!$db){
			echo '<script>alert("無法連接至MySQL")</script>';
			returnToSetup();
		}
		if(mysqli_select_db($db, $_POST['dbName'])){
			echo '<script>alert("此資料庫已存在")</script>';
			returnToSetup();
		}
		$query = 'CREATE DATABASE '.$_POST['dbName'];
		if(!mysqli_query($db, $query)){
			echo '<script>alert("無法建立資料庫")</script>';
			returnToSetup();
		}

		// Write user information into dbSetting.php
		$file = fopen('dbSetting.php', 'w');
		$text = '<?php
				$username = "'.$_POST['dbUsername'].'";
				$password = "'.$_POST['dbPassword'].'";
				$dbName = "'.$_POST['dbName'].'";
				?>';
		fwrite($file, $text);
		fclose($file);

		// Redirect index.php to accountintSystem.php
		$file = fopen("index.php", "w");
		$text = '<?php header("location: accountingSystem.php");?>';
		fwrite($file, $text);
		fclose($file);

		// Create tables
		mysqli_select_db($db, $_POST['dbName']);
		$query = 'CREATE TABLE IF NOT EXISTS company(
			id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
			name VARCHAR(50) NOT NULL,
			initialAsset INT NOT NULL,
			initialLiability INT NOT NULL)';
		mysqli_query($db, $query);
		$query = 'CREATE TABLE IF NOT EXISTS receivable(
			id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
			companyId INT NOT NULL,
			name VARCHAR(50) NOT NULL,
			num INT NOT NULL,
			pricePerUnit INT NOT NULL,
			recordDate VARCHAR(20) NOT NULL)';
		mysqli_query($db, $query);
		$query = 'CREATE TABLE IF NOT EXISTS payable(
			id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
			companyId INT NOT NULL,
			name VARCHAR(50) NOT NULL,
			num INT NOT NULL,
			pricePerUnit INT NOT NULL,
			recordDate VARCHAR(20) NOT NULL)';
		mysqli_query($db, $query);
		mysqli_close($db);
		echo '<script>alert("網站設定完成")</script>';
        echo '<script>document.location.href = "index.php";</script>';
	}
	else{
		header('location: index.php');
	}

?>
