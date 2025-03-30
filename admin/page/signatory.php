<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
	<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
		<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
			<h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Manage</h1>
			<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
				<li class="breadcrumb-item text-muted"><?php echo ucfirst(str_replace(' ', '_', $page)); ?></li>
			</ul>
		</div>
	</div>
</div>

<?php
// Ensure database connection is established
if (!isset($conn)) {
    die("Database connection error");
}

$table = 'signatory';
$error = "";

// Optimized SQL Query using JOINs
$sql = "SELECT t.*, 
        s.id AS student_id, s.firstname, s.lastname,
        o.name AS office_name
        FROM signatory t
        JOIN student s ON t.student_id = s.id
        JOIN offices o ON t.signatory_list_id = o.id";

$result = $conn->query($sql);

// Prevent duplicate student records in the table
$studentRecords = [];
$displayedStudents = [];

?>

<div class="container">
	<?php echo $error ?>
	<table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
	    <thead>
	        <tr class="fw-bold fs-6 text-gray-800 px-7">
	        	<th>Student</th>
	            <th>Offices</th>
	            <th>Status</th>
	            <th>Date</th>
	        </tr>
	    </thead>
	    <tbody>
		<?php
		if ($result && $result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				$studentKey = $row['student_id']; // Unique ID per student

				// Store all student records for modal display
				$studentRecords[$studentKey][] = $row;

				// Display student **only once** in the main table
				if (!isset($displayedStudents[$studentKey])) {
					$displayedStudents[$studentKey] = true;
					?>
					<tr class="clickable-row" data-bs-toggle="modal" data-bs-target="#detailsModal"
						data-studentkey="<?php echo htmlspecialchars($studentKey); ?>">
						<td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></td>
						<td><?php echo $row['office_name']; ?></td>
						<td><?php echo $row['status']; ?></td>
						<td><?php echo $row['date_created']; ?></td>
					</tr>
					<?php
				}
			}
		} else {
			echo "<tr><td colspan='4' class='text-center text-danger'>No records found</td></tr>";
		}
		?>
	    </tbody>
	</table>
</div>

<!-- Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailsModalLabel">Student Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table">
          <thead>
            <tr>
              <th>Student</th>
              <th>Offices</th>
              <th>Status</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody id="modal-body-content">
            <!-- Data will be loaded dynamically -->
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	function table() {
		$("#kt_datatable_dom_positioning").DataTable({
			"language": {
				"lengthMenu": "Show _MENU_",
			},
			"dom":
				"<'row mb-2'" +
				"<'col-sm-6 d-flex align-items-center justify-content-start dt-toolbar'l>" +
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

	// Store all student records for modal display
	const studentRecords = <?php echo json_encode($studentRecords); ?>;

	// Handle row click to populate modal dynamically
	document.addEventListener("DOMContentLoaded", function() {
		document.querySelectorAll(".clickable-row").forEach(row => {
			row.addEventListener("click", function() {
				const studentKey = this.dataset.studentkey;
				const records = studentRecords[studentKey];

				// Clear previous modal content
				let modalContent = "";
				records.forEach(record => {
					modalContent += `
						<tr>
							<td>${record.firstname} ${record.lastname}</td>
							<td>${record.office_name}</td>
							<td>${record.status}</td>
							<td>${record.date_created}</td>
						</tr>`;
				});

				// Insert data into modal
				document.getElementById("modal-body-content").innerHTML = modalContent;
			});
		});
	});
</script>
