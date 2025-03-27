<?php
		include'connect/connect.php';
		session_start();

		
		
		if(isset($_POST['email'])){
			extract($_POST);  // extracting data from array
			$passwords=md5($password);

			$sql = "SELECT * FROM admin WHERE email='$email' LIMIT 1";
			$result = $conn->query($sql);

			$sql1 = "SELECT * FROM offices WHERE email='$email' LIMIT 1";
			$result1 = $conn->query($sql1);

			

			if ($result->num_rows > 0) {
			  // output data of each row
			  while($row = $result->fetch_assoc()) {
			  	extract($row);
			    if($passwords==$password){
			    	$_SESSION['id']=$id;
			    	$_SESSION['type']=$type;
			    		header("location: ".$type."/" );
			    }else{
			    	?>
			    	<script type="text/javascript">
			    		alert("wrong password");
			    		location.href="./";
			    	</script>
			    	<?php
			    }
			  }
			}else if ($result1->num_rows > 0) {
				// output data of each row
				  while($row1 = $result1->fetch_assoc()) {
				  	extract($row1);
				    if($passwords==$password){
				    	$_SESSION['id']=$id;
				    	$_SESSION['type']=$type;
				    		header("location: ".$type."/" );
				    }else{
				    	?>
				    	<script type="text/javascript">
				    		alert("wrong password");
				    		location.href="./";
				    	</script>
				    	<?php
				    }
				  }
			}else {
			 	$sql = "SELECT * FROM student WHERE email='$email' LIMIT 1";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
				  // output data of each row
				  while($row = $result->fetch_assoc()) {
				  	extract($row);
				    if($passwords==$password){
				    	$_SESSION['id']=$id;
				    	$_SESSION['type']=$type;
				    		header("location: ".$type."/" );
				    }else{
				    	?>
				    	<script type="text/javascript">
				    		alert("wrong password");
				    		location.href="./";
				    	</script>
				    	<?php
				    }
				  }
				} else {
				  ?>
				    	<script type="text/javascript">
				    		alert("No account found");
				    		location.href="./";
				    	</script>
				    	<?php
				}
			}
		}

?>