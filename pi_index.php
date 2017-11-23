<?php
	include 'databaseConnection.php';
	//light
	function updateStatus($sta,$id)
	{
		date_default_timezone_set('Asia/Dhaka');
		
		$conn = OpenCon();
		
		$sql = "UPDATE Devices SET Status='". $sta."', Last_Updated='". date('d/m/Y H:i:s') ."' WHERE id=" . $id;
		
		if ($conn->query($sql) === false) {
			echo "Error updating record: " . $conn->error;
		}
		CloseCon($conn);
	}
	
	function getStatus($id)
	{
		$conn = OpenCon();
		
		$sql = "SELECT ID, Status, Last_Updated FROM Devices where id=" . $id;
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				return $row["Status"];
			}
		}
		CloseCon($conn);
	}
	
	function getTime($id)
	{
		$conn = OpenCon();
		
		$sql = "SELECT ID, Status, Last_Updated FROM Devices";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				return $row["Last_Updated"];
			}
		}
		CloseCon($conn);
	}

	if(isset($_REQUEST['1']))
	{
		updateStatus(0,1);
	}

	if(isset($_REQUEST['0']))
	{
		updateStatus(1,1);
	}

	$status = getStatus(1);
	$time = getTime(1);

	$color = 'green';
	if($status == 0)
	{
		$color = 'red';
	}

	
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		body{
			font-family: Arial
		}
	</style>
</head>
<body>
	<div style="float: left;">
		<div>
			<table cellpadding="5" cellspacing="5">
				<tr>
					<td><strong>Current Status:</strong></td>
					<td style="color: <?php echo $color; ?>">
						<?php 
							if($status == 0)
								echo 'Off'; 
							else 
								echo 'On'; 
						?>
					</td>
				</tr>
				<tr>
					<td><strong>Last Changed:</strong></td>
					<td><?php echo $time; ?></td>
				</tr>
			</table>
		</div>
		<br/>

		<div>
			<table cellpadding="5" cellspacing="5">
				<tr>
					<td>
						<form method="post">
							<label> Light:</label> <input type="submit" 
							value=
							"<?php 
								if($status == 0)
									echo 'Switch On'; 
								else 
									echo 'Switch Off'; 
								?>" 
							name= 
							"<?php echo $status; ?>">
						</form>
					</td>
					
				</tr>
			</table>
		</div>
	</div>
	<!-- fan
	<div style="float: left;">
		<div>
			<table cellpadding="5" cellspacing="5">
				<tr>
					<td><strong>Current Status:</strong></td>
					<td style="color: <?php echo $color_fan; ?>">
						<?php 
							if($status_fan == 'fan_on')
								echo 'Off'; 
							else 
								echo 'On'; 
							?>
					</td>
				</tr>
				<tr>
					<td><strong>Last Changed:</strong></td>
					<td><?php echo $time_fan; ?></td>
				</tr>
			</table>
		</div>
		<br/>

		<div>
			<table cellpadding="5" cellspacing="5">
				<tr>
					<td>
						<form method="post">
							<label> Fan:</label> 
							<input type="submit" 
							value=
							"<?php 
								if($status_fan == 'fan_on')
									echo 'Switch On'; 
								else 
									echo 'Switch Off'; 
								?>" 
							name = "<?php echo $status_fan; ?>">
						</form>
					</td>
					
				</tr>
			</table>
		</div>
	</div>
	
	<br/> -->
	
</body>
</html>