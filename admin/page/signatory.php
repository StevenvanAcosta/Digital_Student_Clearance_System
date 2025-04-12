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
// Ensure database connection is set
if (!isset($conn)) {
    die("Database connection error");
}

$table = 'signatory';
$error = "";

// Use prepared statements to avoid SQL injection
$sql = "SELECT t.*, 
        s.student_id AS student_id, s.firstname, s.lastname, s.year_level, s.courses AS course, s.section,
        o.name AS office_name, t.status, t.date_created
        FROM signatory t
        JOIN student s ON t.student_id = s.id
        JOIN offices o ON t.signatory_list_id = o.id";

$result = $conn->query($sql);

if (!$result) {
    die("Query Error: " . $conn->error);
}

$studentRecords = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get POST data
    $student_id = $conn->real_escape_string($_POST['student_id']);
    $firstname = $conn->real_escape_string($_POST['firstname']);
    $lastname = $conn->real_escape_string($_POST['lastname']);
    $year_level = $conn->real_escape_string($_POST['year_level']);
    $course = $conn->real_escape_string($_POST['course']);
    $section = $conn->real_escape_string($_POST['section']);
    
    // Determine status based on action (approve or decline)
    $status = isset($_POST['approve']) ? 'Cleared' : 'Not Cleared';
    
    // Check if student_id already exists in the student_status table
    $check_sql = "SELECT * FROM student_status WHERE student_id = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("s", $student_id);
    $stmt->execute();
    $existingRecord = $stmt->get_result()->fetch_assoc();
    
    if ($existingRecord) {
        // If the student already exists, update the status
        $update_sql = "UPDATE student_status SET status = ? WHERE student_id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ss", $status, $student_id);
        
        if ($update_stmt->execute()) {
            $success_message = "Student status updated to $status.";
        } else {
            $error_message = "Error: " . $conn->error;
        }
    } else {
        // If the student does not exist, insert a new record
        $insert_sql = "INSERT INTO student_status (student_id, firstname, lastname, year_level, courses, section, status) 
                       VALUES (?, ?, ?, ?, ?, ?, ?)";
        $insert_stmt = $conn->prepare($insert_sql);
        $insert_stmt->bind_param("sssssss", $student_id, $firstname, $lastname, $year_level, $course, $section, $status);
        
        if ($insert_stmt->execute()) {
            $success_message = "Student has been added with status: $status.";
        } else {
            $error_message = "Error: " . $conn->error;
        }
    }
}

// Prepare data for display
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $studentKey = $row['student_id'];
        $studentRecords[$studentKey][] = $row;
    }
} else {
    echo "<p>No records found.</p>";
}
?>

<!-- Display Success or Error Messages -->
<?php if (isset($success_message)) echo "<p class='alert alert-success'>$success_message</p>"; ?>
<?php if (isset($error_message)) echo "<p class='alert alert-danger'>$error_message</p>"; ?>

<style>
.clickable-row td:hover {
    color: #007bff;
    text-decoration: underline;
    cursor: pointer;
    transition: color 0.3s ease-in-out;
}
</style>

<div class="container">
    <div class="row mb-3">
        <!-- Search Box -->
        <div class="col-md-4 offset-md-8">
            <input type="text" id="searchInput" class="form-control" placeholder="Search Students..." />
        </div>
    </div>

    <table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
        <thead>
            <tr class="fw-bold fs-6 text-gray-800 px-7">
                <th>Student</th>
                <th>Year Level</th>
                <th>Course</th>
                <th>Section</th>
            </tr>
        </thead>
        <tbody>
        <?php
        foreach ($studentRecords as $studentKey => $records) {
            $record = $records[0]; // Get first record for student
            ?>
            <tr class="clickable-row" data-bs-toggle="modal" data-bs-target="#detailsModal" data-studentkey="<?php echo htmlspecialchars($studentKey); ?>">
                <td><?php echo htmlspecialchars($record['firstname'] . ' ' . $record['lastname']); ?></td>
                <td><?php echo htmlspecialchars($record['year_level']); ?></td>
                <td><?php echo htmlspecialchars($record['course']); ?></td>
                <td><?php echo htmlspecialchars($record['section']); ?></td>
            </tr>
            <?php
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
        <div id="student-details">
          <p><strong>Student ID:</strong> <span id="student_id"></span></p>
          <p><strong>Name:</strong> <span id="student_name"></span></p>
          <p><strong>Year Level:</strong> <span id="year_level"></span></p>
          <p><strong>Course:</strong> <span id="course"></span></p>
          <p><strong>Section:</strong> <span id="section"></span></p>
        </div>
        <table class="table">
          <thead>
            <tr>
              <th>Offices</th>
              <th>Status</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody id="modal-body-content"></tbody>
        </table>
        <div class="modal-footer">
          <button type="button" class="btn btn-success" id="approveBtn">Approve</button>
          <button type="button" class="btn btn-danger" id="declineBtn">Decline</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
document.addEventListener("DOMContentLoaded", function() {
    const table = $("#kt_datatable_dom_positioning").DataTable({
        "language": { "lengthMenu": "Show _MENU_" },
        "responsive": true
    });

    document.getElementById("searchInput").addEventListener("input", function() {
        table.search(this.value).draw();
    });

    const studentRecords = <?php echo json_encode($studentRecords, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;

    document.querySelectorAll(".clickable-row").forEach(row => {
        row.addEventListener("click", function() {
            const studentKey = this.dataset.studentkey;
            const records = studentRecords[studentKey];

            if (records && records.length > 0) {
                const studentData = records[0];

                // Populate modal with student data
                document.getElementById("student_id").textContent = studentData.student_id;
                document.getElementById("student_name").textContent = studentData.firstname + ' ' + studentData.lastname;
                document.getElementById("year_level").textContent = studentData.year_level;
                document.getElementById("course").textContent = studentData.course;
                document.getElementById("section").textContent = studentData.section;

                let modalContent = "";
                records.forEach(record => {
                    modalContent += `
                        <tr>
                            <td>${record.office_name}</td>
                            <td>${record.status || 'N/A'}</td>
                            <td>${record.date_created || 'N/A'}</td>
                        </tr>`;
                });
                document.getElementById("modal-body-content").innerHTML = modalContent;
            }
        });
    });

    function handleButtonAction(action) {
        const studentId = document.getElementById("student_id").textContent;
        const studentName = document.getElementById("student_name").textContent.split(' ');
        const firstName = studentName[0];
        const lastName = studentName[1];
        const yearLevel = document.getElementById("year_level").textContent;
        const course = document.getElementById("course").textContent;
        const section = document.getElementById("section").textContent;

        const status = action === "approve" ? "Cleared" : "Not Cleared";

        const isConfirmed = window.confirm(`Are you sure you want to ${action} this student?`);

        if (isConfirmed) {
            const data = {
                student_id: studentId,
                firstname: firstName,
                lastname: lastName,
                year_level: yearLevel,
                course: course,
                section: section,
                [action]: true
            };

            fetch(window.location.href, {
                method: 'POST',
                body: new URLSearchParams(data),
            })
            .then(response => response.text())
            .then(data => {
                alert(`Student has been ${action} and added to student status.`);
                location.reload();
            })
            .catch(error => alert('Error: ' + error));
        } else {
            alert(`${action.charAt(0).toUpperCase() + action.slice(1)} has been canceled.`);
        }
    }

    document.getElementById("approveBtn").addEventListener("click", function() {
        handleButtonAction("approve");
    });

    document.getElementById("declineBtn").addEventListener("click", function() {
        handleButtonAction("decline");
    });
});
</script>
