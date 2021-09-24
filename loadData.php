<?php
	include('connection.php');
	$sql = "SELECT * FROM student";
	$result = mysqli_query($conn, $sql) or die("sql query not running");
	$output = "";
	if(mysqli_num_rows($result) > 0){
		$output = '<table>
					<tr>
					<th>ID</th>
					<th>FIRST NAME</th>
					<th>LAST NAME</th>
					<th>EDIT</th>
					<th>DELETE</th>
					</tr>';
					
					while($row = mysqli_fetch_assoc($result)){
						$output .= "<tr>
									<td>{$row["ID"]}</td>
									<td>{$row["NAME"]}</td>
									<td>{$row["LASTNAME"]}</td>
									<td><button class='edit-btn' data-id='{$row["ID"]}'>Edit</button></td>
									<td><button Class='delete-btn' data-id='{$row["ID"]}'>Delete</button></td>
									</tr>";
					}
		$output .= '</table>';
		mysqli_close($conn);
		echo $output;
	}else{
		echo "No Record Found";
	}
	
?>