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
$table2 = "school_year";
$error = "";
$success = "";

// Assuming the database connection ($conn) is properly initialized here
$tableschoolyear = "school_year";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['school_year_end'])) {
    $school_year_end = $_POST['school_year_end'];
    $date_time = date("Y-m-d H:i:s");  // Get current date and time

    // Check if the school year already exists in the database
    $stmt = $conn->prepare("SELECT * FROM $tableschoolyear WHERE school_year_end = ?");
    $stmt->bind_param("s", $school_year_end);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // School year already exists
        $error = "This school year already exists.";
    } else {
        // Prepare and execute the SQL statement for insert
        $stmt = $conn->prepare("INSERT INTO $tableschoolyear (school_year_end, date_time) VALUES (?, ?)");
        $stmt->bind_param("ss", $school_year_end, $date_time); // Use 'ss' because both are strings

        if ($stmt->execute()) {
            $success = "New School Year Successfully Added!";
        } else {
            $error = "Error: " . $stmt->error;
        }
    }

    $stmt->close();
}
?>

<div class="container">
    <?php echo $error; ?>
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

    <!-- Modal School Year -->
    <div class="modal fade" id="settingsModal" tabindex="-1" aria-labelledby="settingsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="settingsModalLabel">School Year</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Success or Error messages at the top -->
                    <?php if ($success) { echo "<div class='alert alert-success'>$success</div>"; } ?>
                    <?php if ($error) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

                    <!-- Input field for setting school year -->
                    <form id="schoolYearForm" method="POST">
                        <div class="mb-3">
                            <label for="inputSchoolYear" class="form-label">Add School Year</label>
                            <!-- Limit the input to 11 characters -->
                            <input type="text" class="form-control" id="inputSchoolYear" name="school_year_end" placeholder="e.g., 2020 - 2021" required maxlength="11">
                        </div>

                        <!-- Table -->
                        <div class="table-responsive" style="max-height: 300px; overflow-y: auto;">
                            <table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
                                <thead>
                                    <tr class="fw-bold fs-6 text-gray-800 px-7">
                                        <th>School Year</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM $tableschoolyear";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $school_year = $row['school_year_end'];
                                            ?>
                                            <tr>
                                                <td><?php echo $school_year; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='1'>No data available</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveSettingsBtn">Save</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const schoolYearPattern = /^\d{4} - \d{4}$/;

        document.getElementById("saveSettingsBtn").addEventListener("click", function() {
            const schoolYearInput = document.getElementById("inputSchoolYear").value.trim();
            
            if (!schoolYearPattern.test(schoolYearInput)) {
                alert("Please enter a valid school year in the format 'YYYY - YYYY'.");
                return;
            }

            document.getElementById("schoolYearForm").submit();
        });
    </script>
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
