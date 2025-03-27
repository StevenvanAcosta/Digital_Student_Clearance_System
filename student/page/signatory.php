<?php
	$table='courses';
	$error="";
?>

<div class="container">
	<?php echo$error?>
	<table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
	    <thead>
	        <tr class="fw-bold fs-6 text-gray-800 px-7">
	            <th>Offices</th>
	            <th>Status</th>
	        </tr>
	    </thead>
	    <tbody>
	    	<?php
	    		$sql = "SELECT t.*
	    		 FROM $table t WHERE name='$courses' AND year_level='$year_level' AND section='$section'";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
				  // output data of each row
				  while($row = $result->fetch_assoc()) {
				  	extract($row);

				  	$sql = "SELECT sl.*,
				  	(SELECT name FROM offices WHERE id=sl.offices_id ) AS offices
				  	 FROM signatory_list sl WHERE courses_id='$id'";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
					  // output data of each row
					  while($row = $result->fetch_assoc()) {
					  	extract($row);

					  	$sql2 = "SELECT * FROM signatory WHERE signatory_list_id='$offices_id' AND student_id='$user_id'";
						$result2 = $conn->query($sql2);

						if ($result2->num_rows > 0) {
						  	$status='Approve';
						}else{
							$status='Pending';
						}

					  	?>
					  	<tr>
					  		<td><?php echo$offices?></td>
					  		<td><?php echo$status?></td>
					  	</tr>
					  	<?php
					  	
					    
					  }
					}
				    
				  }
				}
	    	?>
	    </tbody>
	</table>
</div>

<script type="text/javascript">
	function table(){
		$("#kt_datatable_dom_positioning").DataTable({
			"language": {
				"lengthMenu": "Show _MENU_",
			},
			"dom":
				"<'row mb-2'" +
				"<'col-sm-6 d-flex align-items-center justify-conten-start dt-toolbar'l>" +
				"<'col-sm-6 d-flex align-items-center justify-content-end dt-toolbar'f>" +
				">" +

				"<'table-responsive'tr>" +

				"<'row'" +
				"<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
				"<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
				">"
		});
	}
	

	 setTimeout(function() {
	 	table();
	 }, 1000);

</script>