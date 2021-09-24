<?php
	$id = $_POST['Id'];
	include('connection.php');
	$sql = "SELECT * FROM student WHERE ID = '{$id}'";
	$result = mysqli_query($conn, $sql) or die("sql query not running");
	$row = mysqli_fetch_assoc($result);
	$currName = $row['NAME']." ".$row['LASTNAME'];
	//echo $result;
	echo $currName;
?>