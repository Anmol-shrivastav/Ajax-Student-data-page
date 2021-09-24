<?php
	$id = $_POST['Id'];
	$fname = $_POST['first_name'];
	$lname = $_POST['last_name'];
	include('connection.php');
	$sql = "UPDATE student SET NAME='{$fname}', LASTNAME='{$lname}' WHERE ID = '{$id}'";
	if(mysqli_query($conn, $sql)){
		echo 1;
	}else{
		echo 0;
	}
?>