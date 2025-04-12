<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
	<!--begin::Toolbar container-->
	<div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
		<!--begin::Page title-->
		<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
			<!--begin::Title-->
			<h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Manage</h1>
			<!--end::Title-->
			<!--begin::Breadcrumb-->
			<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
				<!--begin::Item-->
				<li class="breadcrumb-item text-muted"><?php echo ucfirst(str_replace(' ', '_', $page)) ;?></li>
				<!--end::Item-->
			</ul>
			<!--end::Breadcrumb-->
		</div>
		<!--end::Page title-->
	</div>
	<!--end::Toolbar container-->
</div>

<?php
$table = "student_status";
$table2 ="school_year";
$error = "";
?>

<div class="container">
    <?php echo $error ?>
    
    <!-- Dropdown Menu Bar -->
    <div class="d-flex justify-content-end mb-3">
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="manageMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                Manage
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="manageMenuButton">
                <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#settingsModal">School Year</a></li>
                <li><a class="dropdown-item" href="#">Clearance Record</a></li>
            </ul>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="settingsModal" tabindex="-1" aria-labelledby="settingsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="settingsModalLabel">School - Year</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Selection fields inside the modal -->
                <!-- New input field for setting school year -->
                <div class="mb-3">
                    <label for="inputSchoolYear" class="form-label">Add School Year</label>
                    <input type="text" class="form-control" id="inputSchoolYear" placeholder="e.g., 2024-2025">
                </div>

				<!-- Table -->
				<table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
					<thead>
						<tr class="fw-bold fs-6 text-gray-800 px-7">
							<th>School - Year</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sql = "SELECT * FROM $table";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							while ($row = $result->fetch_assoc()) {
								$student_id = $row['student_id'];
								?>
								<tr>
									<td><?php echo $student_id; ?></td>
								</tr>
								<?php
							}
						} else {
							echo "<tr><td colspan='8'>No data available</td></tr>";
						}
						?>
					</tbody>
				</table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveSettingsBtn">Save</button>
            </div>
        </div>
    </div>
</div>


    <!-- Table -->
    <table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
        <thead>
            <tr class="fw-bold fs-6 text-gray-800 px-7">
                <th>Select</th>
                <th>Student Id</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Year Level</th>
                <th>Course</th>
                <th>Section</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM $table";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $student_id = $row['student_id'];
                    $firstname = $row['firstname'];
                    $lastname = $row['lastname'];
                    $courses = $row['courses'];
                    $year_level = $row['year_level'];
                    $section = $row['section'];
                    $status = $row['status'];
                    ?>
                    <tr>
                        <td></td>
                        <td><?php echo $student_id; ?></td>
                        <td><?php echo $firstname; ?></td>
                        <td><?php echo $lastname; ?></td>
                        <td><?php echo $year_level; ?></td>
                        <td><?php echo $courses; ?></td>
                        <td><?php echo $section; ?></td>
                        <td><?php echo $status; ?></td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='8'>No data available</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- JavaScript -->
<script type="text/javascript">
    // Initialize the DataTable
    function table() {
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

    setTimeout(function () {
        table();
    }, 1000);

    // Save button functionality
    document.getElementById("saveSettingsBtn").addEventListener("click", function () {
        var select1 = document.getElementById("selectField1").value;
        var select2 = document.getElementById("selectField2").value;

        console.log("Selected Option 1: " + select1);
        console.log("Selected Option 2: " + select2);

        $('#settingsModal').modal('hide');
    });
</script>
