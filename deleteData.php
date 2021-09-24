<?php
	$id = $_POST['ID'];
	include('connection.php');
	$sql = "DELETE FROM student WHERE ID = {$id}";
	if(mysqli_query($conn, $sql)){
		echo 1;
	}else{
		echo 0;
	}
?>