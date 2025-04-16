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


<?php
$table = "student_status";
$tableschoolyear = "school_year";
$table3 = "student_clearance_record"; // Fixed missing semicolon
$error = "";
$success = "";



// Handle form submission for adding school year
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['school_year_end'])) {
    $school_year_end = $_POST['school_year_end'];
    $date_time = date("Y-m-d H:i:s");  // Get current date and time

    // Check if the school year already exists in the database
    $stmt = $conn->prepare("SELECT * FROM $tableschoolyear WHERE school_year_end = ?");
    $stmt->bind_param("s", $school_year_end);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $error = "This school year already exists.";
    } else {
        // Prepare and execute the SQL statement for insert
        $stmt = $conn->prepare("INSERT INTO $tableschoolyear (school_year_end, date_time) VALUES (?, ?)");
        $stmt->bind_param("ss", $school_year_end, $date_time);

        if ($stmt->execute()) {
            $success = "New School Year Successfully Added!";
        } else {
            $error = "Error: " . $stmt->error;
        }
    }

    $stmt->close();
}

// Handle archive submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['student_ids']) && isset($_POST['semester']) && isset($_POST['school_year'])) {
    $student_ids = $_POST['student_ids'];
    $semester = $_POST['semester'];
    $school_year = $_POST['school_year'];

    foreach ($student_ids as $student_id) {
        $stmt = $conn->prepare("SELECT firstname, lastname, year_level, courses, section, status FROM $table WHERE student_id = ?");
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $year_level = $row['year_level'];
            $courses = $row['courses'];
            $section = $row['section'];
            $status = $row['status'];

            $insertStmt = $conn->prepare("INSERT INTO $table3 (student_id, firstname, lastname, year_level, courses, section, status, semester, school_year) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $insertStmt->bind_param("sssssssss", $student_id, $firstname, $lastname, $year_level, $courses, $section, $status, $semester, $school_year);
            $insertStmt->execute();
            $insertStmt->close();

            // Delete from student_status after successful insert
            $deleteStmt = $conn->prepare("DELETE FROM student_status WHERE student_id = ?");
            $deleteStmt->bind_param("s", $student_id);
            $deleteStmt->execute();
            $deleteStmt->close();
        }

        $stmt->close();
    }

    $success = "Selected students archived successfully.";
}


?>
<?php
    if ($success) {
        echo "
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> $success
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }
?>

<!-- SIDE MENU MANAGE -->
<div class="container">
    <?php
        if ($error) echo "<div class='alert alert-danger'>$error</div>";
    ?>

    <!-- Modal School Year -->
    <div class="modal fade" id="settingsModal" tabindex="-1" aria-labelledby="settingsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="settingsModalLabel">School Year</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if ($success) { echo "<div class='alert alert-success'>$success</div>"; } ?>
                    <?php if ($error) { echo "<div class='alert alert-danger'>$error</div>"; } ?>

                    <form id="schoolYearForm" method="POST">
                        <div class="mb-3">
                            <label for="inputSchoolYear" class="form-label">Add School Year</label>
                            <input type="text" class="form-control" id="inputSchoolYear" name="school_year_end" placeholder="e.g., 2020 - 2021" required maxlength="11">
                        </div>

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

<!-- SCRIPT FOR SCHOOL YEAR -->
<script>
    const schoolYearPattern = /^\d{4} - \d{4}$/;

    document.getElementById("saveSettingsBtn").addEventListener("click", function() {
    const schoolYearInput = document.getElementById("inputSchoolYear").value.trim();
    
    if (!schoolYearPattern.test(schoolYearInput)) {
        alert("Please enter a valid school year in the format 'YYYY - YYYY'.");
        return;
    }

    // Display success alert
    alert("School Year successfully saved!");

    document.getElementById("schoolYearForm").submit();
});

</script>
</div>


<div class="container">
    <div class="mb-3 d-flex container justify-content-between align-items-center">
        <div class="d-flex">
            <button class="btn btn-success" id="archiveSelectedBtn">
                <i class="bi bi-archive-fill"></i> Archive Selected
            </button>
        </div>

        <!-- Right-aligned selects and manage button in one row -->
        <div class="d-flex align-items-center gap-3 ms-auto">
            <!-- Select Dropdowns -->
            <form name="add_form" class="d-flex align-items-center gap-2 mb-0">
                <div>
                    <select id="filterCourses" class="form-select form-select-sm" name="courses" onchange="select_year_level(this.value);" style="width: 160px;">
                        <option selected disabled>Filter Courses</option>
                        <?php
                            $sql = "SELECT DISTINCT (name) FROM courses";
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()) {
                                    extract($row);
                                    echo "<option>$name</option>";
                                }
                            }
                        ?>
                    </select>
                </div>

                <div>
                    <select id="filterYearLevel" class="form-select form-select-sm" name="year_level" onchange="select_section(this.value,document.add_form.courses.value);" style="width: 140px;">
                        <option selected disabled>Year Level</option>
                    </select>
                </div>

                <div>
                    <select id="filterSection" class="form-select form-select-sm" name="section" style="width: 140px;">
                        <option selected disabled>Section</option>
                    </select>
                </div>
            </form>
            <!-- Manage Button -->
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="manageMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    Manage
                </button>
                <!-- Export Button -->
                <button class="btn btn-primary btn-sm" id="exportBtn">
                    <i class="bi bi-box-arrow-up"></i> Export
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="manageMenuButton">
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#settingsModal">School Year</a></li>
                </ul>
            </div>
        </div>
    </div>
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

<!-- Data Table -->
<div class="container">
        <table id="kt_datatable_dom_positioning2" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800 px-7">
                    <th><input type="checkbox" id="select-all"></th>
                    <th>Student Id</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Course</th>
                    <th>Year Level</th>
                    <th>Section</th>
                    <th>Status</th>
                    <th>Action</th>
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
                            <td><input type="checkbox" class="row-checkbox" value="<?php echo $student_id; ?>"></td>
                            <td><?php echo $student_id; ?></td>
                            <td><?php echo $firstname; ?></td>
                            <td><?php echo $lastname; ?></td>
                            <td><?php echo $courses; ?></td>
                            <td><?php echo $year_level; ?></td>
                            <td><?php echo $section; ?></td>
                            <td><?php echo $status; ?></td>
                            <td>
                                <button class="btn btn-sm btn-outline-secondary archive-btn" data-id="<?php echo $student_id; ?>">
                                    <i class="bi bi-archive"></i> Archive
                                </button>
                            </td>
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
</div>

<!-- ✅ UPDATED ARCHIVE MODAL (multi support) -->
<div class="modal fade" id="archiveModal" tabindex="-1" aria-labelledby="archiveModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="archiveForm" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="archiveModalLabel">Archive Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <!-- ✅ Will be filled with selected student_ids -->
          <div id="archiveStudentIds"></div>

          <div class="mb-3">
            <label for="semester" class="form-label">Select Semester</label>
            <select class="form-select" id="semester" name="semester" required>
              <option value="">-- Select Semester --</option>
              <option value="First Semester">First Semester</option>
              <option value="Second Semester">Second Semester</option>
            </select>
          </div>
          
          <div class="mb-3">
            <label for="schoolYear" class="form-label">Select School Year</label>
            <select class="form-select" id="schoolYear" name="school_year" required>
              <option value="">-- Select School Year --</option>
              <?php
              $yearQuery = "SELECT DISTINCT school_year_end FROM school_year ORDER BY school_year_end DESC";
              $yearResult = $conn->query($yearQuery);
              if ($yearResult->num_rows > 0) {
                  while ($yearRow = $yearResult->fetch_assoc()) {
                      $schoolYear = $yearRow['school_year_end'];
                      echo "<option value='{$schoolYear}'>{$schoolYear}</option>";
                  }
              }
              ?>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Archive</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- PHP HANDLER FOR MULTIPLE STUDENT ARCHIVE -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['student_ids']) && isset($_POST['semester']) && isset($_POST['school_year'])) {
    $student_ids = $_POST['student_ids'];
    $semester = $_POST['semester'];
    $school_year = $_POST['school_year'];

    $insertedCount = 0;
    $skippedCount = 0;

    foreach ($student_ids as $student_id) {
        $stmt = $conn->prepare("SELECT firstname, lastname, year_level, courses, section, status FROM $table WHERE student_id = ?");
        $stmt->bind_param("s", $student_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $firstname = $row['firstname'];
            $lastname = $row['lastname'];
            $year_level = $row['year_level'];
            $courses = $row['courses'];
            $section = $row['section'];
            $status = $row['status'];

            // Check for duplicates
            $checkStmt = $conn->prepare("SELECT * FROM $table3 WHERE student_id = ? AND semester = ? AND school_year = ?");
            $checkStmt->bind_param("sss", $student_id, $semester, $school_year);
            $checkStmt->execute();
            $checkResult = $checkStmt->get_result();

            if ($checkResult->num_rows === 0) {
                // Insert if not a duplicate
                $insertStmt = $conn->prepare("INSERT INTO $table3 (student_id, firstname, lastname, year_level, courses, section, status, semester, school_year) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $insertStmt->bind_param("sssssssss", $student_id, $firstname, $lastname, $year_level, $courses, $section, $status, $semester, $school_year);
                $insertStmt->execute();
                $insertStmt->close();
                $insertedCount++;
            } else {
                $skippedCount++;
            }

            $checkStmt->close();
        }

        $stmt->close();
    }

    $success = "Archived $insertedCount student(s). Skipped $skippedCount duplicate(s).";
}

?>

<!-- ✅ JAVASCRIPT UPDATES -->
<script type="text/javascript">
    let datatableInstance;

function table() {
    // Initialize DataTable
    datatableInstance = $("#kt_datatable_dom_positioning").DataTable({
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
    applyFilters(); // Re-apply filters just in case
}, 1000);

     // Handle select-all checkbox
    document.addEventListener('DOMContentLoaded', function () {
        // ✅ Select All
        document.getElementById('select-all').addEventListener('change', function () {
            const isChecked = this.checked;
            document.querySelectorAll('.row-checkbox').forEach(checkbox => {
                checkbox.checked = isChecked;
            });
        });
    });

    // ✅ Individual Archive Button
    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.archive-btn');
        if (btn) {
            const studentId = btn.getAttribute('data-id');

            const hiddenWrapper = document.getElementById('archiveStudentIds');
            hiddenWrapper.innerHTML = ''; // Clear previous
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'student_ids[]';
            input.value = studentId;
            hiddenWrapper.appendChild(input);

            const modal = new bootstrap.Modal(document.getElementById('archiveModal'));
            modal.show();
        }
    });

    // ✅ Archive Selected Button Logic
    document.getElementById('archiveSelectedBtn').addEventListener('click', function () {
        const selectedCheckboxes = document.querySelectorAll('.row-checkbox:checked');
        if (selectedCheckboxes.length === 0) {
            alert('Please select at least one student.');
            return;
        }

        const ids = Array.from(selectedCheckboxes).map(cb => cb.value);
        const wrapper = document.getElementById('archiveStudentIds');
        wrapper.innerHTML = '';

        ids.forEach(id => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'student_ids[]';
            input.value = id;
            wrapper.appendChild(input);
        });

        const modal = new bootstrap.Modal(document.getElementById('archiveModal'));
        modal.show();
    });

    // ✅ Archive Form Validation
    document.getElementById('archiveForm').addEventListener('submit', function (e) {
        const ids = document.querySelectorAll('input[name="student_ids[]"]');
        const semester = document.getElementById('semester').value;
        const schoolYear = document.getElementById('schoolYear').value;

        if (ids.length === 0 || !semester || !schoolYear) {
            e.preventDefault();
            alert("Please fill out all fields and select at least one student.");
        }
    });

    function select_year_level(courses) {
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	     document.add_form.year_level.innerHTML = this.response;
	    }
	  };
	  xhttp.open("GET", "select.php?courses="+courses, true);
	  xhttp.send();
	}
    function select_section(year_level,course) {
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	     document.add_form.section.innerHTML = this.response;
	    }
	  };
	  xhttp.open("GET", "select.php?year_level="+year_level+"&course="+course, true);
	  xhttp.send();
	}

	function select_year_levels(courses) {
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	     document.edit_form.year_level.innerHTML = this.response;
	    }
	  };
	  xhttp.open("GET", "select.php?courses="+courses, true);
	  xhttp.send();
	}

	function select_sections(year_level,course) {
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	     document.edit_form.section.innerHTML = this.response;
	    }
	  };
	  xhttp.open("GET", "select.php?year_level="+year_level+"&course="+course, true);
	  xhttp.send();
	}
    setTimeout(function() {
    const form = document.forms['add_form'];
    if (form) {
        form.year_level.value = year_level;
        select_sections(year_level, courses);
    }
    }, 300);

    setTimeout(function() {
        const form = document.forms['add_form'];
        if (form) {
            form.section.value = section;
        }
    }, 500);
    function applyFilters() {
        const course = document.getElementById('filterCourses').value;
        const yearLevel = document.getElementById('filterYearLevel').value;
        const section = document.getElementById('filterSection').value;

        // Apply filters to DataTable columns (Courses, Year Level, Section)
        datatableInstance.columns(4).search(course || '', true, false);  // Column 4 - Courses
        datatableInstance.columns(5).search(yearLevel || '', true, false); // Column 5 - Year Level
        datatableInstance.columns(6).search(section || '', true, false);  // Column 6 - Section
        datatableInstance.draw();
    }

    // Event listeners for dropdown changes to apply filters
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('filterCourses').addEventListener('change', applyFilters);
        document.getElementById('filterYearLevel').addEventListener('change', applyFilters);
        document.getElementById('filterSection').addEventListener('change', applyFilters);
    });

    // Functions for populating Year Level and Section based on Courses and Year Level
    function select_year_level(courses) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.add_form.year_level.innerHTML = this.response;
            }
        };
        xhttp.open("GET", "select.php?courses=" + courses, true);
        xhttp.send();
    }

    function select_section(year_level, course) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                document.add_form.section.innerHTML = this.response;
            }
        };
        xhttp.open("GET", "select.php?year_level=" + year_level + "&course=" + course, true);
        xhttp.send();
    }

    setTimeout(function () {
        const form = document.forms['add_form'];
        if (form) {
            form.year_level.value = year_level;
            select_sections(year_level, courses);
        }
    }, 300);

    setTimeout(function () {
        const form = document.forms['add_form'];
        if (form) {
            form.section.value = section;
        }
    }, 500);
</script>

<script>
    // Show modal on export button click
    document.getElementById("exportBtn").addEventListener("click", function () {
        var exportModal = new bootstrap.Modal(document.getElementById('exportConfirmModal'));
        exportModal.show();
    });

    // Confirm and trigger Excel export
    document.getElementById("confirmExport").addEventListener("click", function () {
        exportTableToExcel('Student Clearance Status export.xlsx');
        bootstrap.Modal.getInstance(document.getElementById('exportConfirmModal')).hide();
    });

    function exportTableToExcel(filename) {
        const originalTable = document.getElementById("kt_datatable_dom_positioning2");
        const clonedTable = originalTable.cloneNode(true);

        // Find index of "Action" column from the header row
        const headers = clonedTable.querySelectorAll("thead tr th");
        let actionColIndex = -1;
        headers.forEach((th, index) => {
            if (th.textContent.trim().toLowerCase() === "action") {
                actionColIndex = index;
            }
        });

        if (actionColIndex !== -1) {
            // Remove the "Action" column from all rows
            clonedTable.querySelectorAll("tr").forEach(row => {
                const cells = row.querySelectorAll("th, td");
                if (cells.length > actionColIndex) {
                    cells[actionColIndex].remove();
                }
            });
        }

        const workbook = XLSX.utils.table_to_book(clonedTable, { sheet: "Sheet1" });
        XLSX.writeFile(workbook, filename);
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>