<?php
	include('dbSetting.php');
?>
<?php
    // Connect to the database
    $db = mysqli_connect("localhost", $username, $password);
    if(!$db){
        echo '<script>alert("無法連接至MySQL")</script>';
        die();
    }
    if(!mysqli_select_db($db, $dbName)){
        echo '<script>alert("無法連接至資料庫")</script>';
        die();
    }
?>