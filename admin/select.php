<?php
	include'../connect/connect.php';

	if(isset($_GET['courses'])){
		extract($_GET);
		?><option></option><?php

			$sql = "SELECT DISTINCT year_level FROM courses WHERE name='$courses'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			  // output data of each row
			  while($row = $result->fetch_assoc()) {
			  	extract($row);
			   ?><option><?php echo$year_level?></option><?php
			  }
			}

	}


	if(isset($_GET['year_level'])){
		extract($_GET);
		?><option></option><?php

			$sql = "SELECT DISTINCT section FROM courses WHERE name='$course' AND year_level='$year_level'";
			$result = $conn->query($sql);

			if ($result->num_rows > 0) {
			  // output data of each row
			  while($row = $result->fetch_assoc()) {
			  	extract($row);
			   ?><option><?php echo$section?></option><?php
			  }
			}

	}
?>