<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">Archieve</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="index.html" class="text-muted text-hover-primary"><i class="bi bi-gear"></i></a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-500 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted"><?php echo ucfirst(str_replace(' ', '_', $page)) ;?></li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <!--begin::Primary button-->
            <!-- <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_1">Add Data</a> -->
            <!--end::Primary button-->
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Toolbar container-->
</div>

<!-- Function for School Year -->
<?php
$table = "student_status";
$tableschoolyear = "school_year";
$table3 = "student_clearance_record";
$error = "";
$success = "";
?>
<div class="mb-3 d-flex container justify-content-between align-items-center">
    <!-- Right-aligned selects and button -->
    <div class="d-flex gap-2 align-items-center ms-auto">
        <!-- Select Dropdown 1: Semester -->
        <select class="form-select form-select-sm w-auto" id="semesterSelect">
            <option selected disabled>Select Semester</option>
            <option value="First Semester">First Semester</option>
            <option value="Second Semester">Second Semester</option>
        </select>

        <!-- Select Dropdown 2: School Year -->
        <select class="form-select form-select-sm w-auto" id="schoolYearSelect">
            <option selected disabled>Select School Year</option>
            <?php
                // Assuming you want to populate school years dynamically
                $sy_query = "SELECT DISTINCT school_year FROM $table3 ORDER BY school_year DESC";
                $sy_result = $conn->query($sy_query);
                if ($sy_result->num_rows > 0) {
                    while ($sy_row = $sy_result->fetch_assoc()) {
                        echo "<option value='" . $sy_row['school_year'] . "'>" . $sy_row['school_year'] . "</option>";
                    }
                }
            ?>
        </select>

        <!-- Export Button -->
        <button class="btn btn-primary" id="exportBtn">
            <i class="bi bi-box-arrow-up"></i> Export
        </button>
    </div>
</div>

<div class="container">
    <table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
        <thead>
            <tr class="fw-bold fs-6 text-gray-800 px-7">
                <th>Student Id</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Year Level</th>
                <th>Course</th>
                <th>Section</th>
                <th>Status</th>
                <th>Semester</th>
                <th>School Year</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT * FROM $table3";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?= $row['student_id']; ?></td>
                            <td><?= $row['firstname']; ?></td>
                            <td><?= $row['lastname']; ?></td>
                            <td><?= $row['year_level']; ?></td>
                            <td><?= $row['courses']; ?></td>
                            <td><?= $row['section']; ?></td>
                            <td><?= $row['status']; ?></td>
                            <td><?= $row['semester']; ?></td>
                            <td><?= $row['school_year']; ?></td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='9'>No data available</td></tr>";
                }
            ?>
        </tbody>
    </table>
</div>

<!-- Export Confirmation Modal -->
<div class="modal fade" id="exportConfirmModal" tabindex="-1" aria-labelledby="exportConfirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exportConfirmModalLabel">Confirm Export</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to export this record?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="confirmExport">Yes, Export</button>
      </div>
    </div>
  </div>
</div>

<!-- ✅ JAVASCRIPT UPDATES -->
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

// Show modal on export button click
document.getElementById("exportBtn").addEventListener("click", function () {
    var exportModal = new bootstrap.Modal(document.getElementById('exportConfirmModal'));
    exportModal.show();
});
// Confirm and trigger Excel export
document.getElementById("confirmExport").addEventListener("click", function () {
    exportTableToExcel('archieve_export.xlsx');
    bootstrap.Modal.getInstance(document.getElementById('exportConfirmModal')).hide();
});
// Function for Export Table to Excel
function exportTableToExcel(filename) {
    const table = document.getElementById("kt_datatable_dom_positioning");
    const workbook = XLSX.utils.table_to_book(table, { sheet: "Sheet1" });
    XLSX.writeFile(workbook, filename);
}
</script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
