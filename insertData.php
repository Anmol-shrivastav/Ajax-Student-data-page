<?php
	$fname = $_POST['first_name'];
	$lname = $_POST['last_name'];
	include('connection.php');
	
	$sql = "INSERT INTO student(NAME, LASTNAME) VALUES('{$fname}', '{$lname}')";

	
	if(mysqli_query($conn, $sql)){
		echo 1;
	}else{
		echo 0;
	}
	
?>