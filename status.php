<?php
	include 'databaseConnection.php';
	function getStatus($id)
	{
		$conn = OpenCon();
		
		$sql = "SELECT ID, Status, Last_Updated FROM Devices where id=" . $id ;
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				return $row["Status"];
			}
		}
		CloseCon($conn);
	}
	
	$status = getStatus(1);
	echo $status,"<br>";
	$status = getStatus(2);
	echo $status;
