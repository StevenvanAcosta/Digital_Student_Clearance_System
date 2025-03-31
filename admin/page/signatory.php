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
$displayedStudents = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['approve'])) {
    // Sanitize input
    $student_id = $conn->real_escape_string($_POST['student_id']);
    $firstname = $conn->real_escape_string($_POST['firstname']);
    $lastname = $conn->real_escape_string($_POST['lastname']);
    $year_level = $conn->real_escape_string($_POST['year_level']);
    $course = $conn->real_escape_string($_POST['course']);
    $section = $conn->real_escape_string($_POST['section']);
    
    // Use prepared statements to avoid SQL injection
    $insert_sql = "INSERT INTO student_status (student_id, firstname, lastname, year_level, courses, section, status) 
                   VALUES (?, ?, ?, ?, ?, ?, 'Cleared')";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("isssss", $student_id, $firstname, $lastname, $year_level, $course, $section);

    if ($stmt->execute()) {
        $success_message = "Student approved and added to student status.";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}

// Decline functionality (using same logic but with "Not Cleared" status)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['decline'])) {
    // Sanitize input
    $student_id = $conn->real_escape_string($_POST['student_id']);
    $firstname = $conn->real_escape_string($_POST['firstname']);
    $lastname = $conn->real_escape_string($_POST['lastname']);
    $year_level = $conn->real_escape_string($_POST['year_level']);
    $course = $conn->real_escape_string($_POST['course']);
    $section = $conn->real_escape_string($_POST['section']);
    
    // Use prepared statements to avoid SQL injection
    $insert_sql = "INSERT INTO student_status (student_id, firstname, lastname, year_level, courses, section, status) 
                   VALUES (?, ?, ?, ?, ?, ?, 'Not Cleared')";
    $stmt = $conn->prepare($insert_sql);
    $stmt->bind_param("isssss", $student_id, $firstname, $lastname, $year_level, $course, $section);

    if ($stmt->execute()) {
        $success_message = "Student declined and added to student status.";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}

// Prepare data for display
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $studentKey = $row['student_id'];
        $studentRecords[$studentKey][] = $row;
        if (!isset($displayedStudents[$studentKey])) {
            $displayedStudents[$studentKey] = true;
        }
    }
} else {
    echo "<p>No records found.</p>";
}
?>

<!-- Function approve -->
<?php if (isset($success_message)) echo "<p class='alert alert-success'>$success_message</p>"; ?>
<?php if (isset($error_message)) echo "<p class='alert alert-danger'>$error_message</p>"; ?>

<!-- HOVER -->
<style>
.clickable-row td:hover {
    color: #007bff;
    text-decoration: underline;
    cursor: pointer;
    transition: color 0.3s ease-in-out;
}
</style>

<div class="container">
    <?php echo $error ?>
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
        if ($result->num_rows > 0) {
            foreach ($studentRecords as $studentKey => $records) {
                $record = $records[0]; // Get first record for student
                ?>
                <tr class="clickable-row" data-bs-toggle="modal" data-bs-target="#detailsModal"
                    data-studentkey="<?php echo htmlspecialchars($studentKey); ?>">
                    <td><?php echo htmlspecialchars($record['firstname'] . ' ' . $record['lastname']); ?></td>
                    <td><?php echo htmlspecialchars($record['year_level']); ?></td>
                    <td><?php echo htmlspecialchars($record['course']); ?></td>
                    <td><?php echo htmlspecialchars($record['section']); ?></td>
                </tr>
                <?php
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
          <tbody id="modal-body-content">
          </tbody>
        </table>
        <!-- Approve and Decline buttons -->
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
    // Set up the DataTable
    function initializeDataTable() {
        $("#kt_datatable_dom_positioning").DataTable({
            "language": {
                "lengthMenu": "Show _MENU_",
            },
            "responsive": true
        });
    }

    setTimeout(initializeDataTable, 500);

    // Extract student records for modal display
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

                // Fill modal with records from the database
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

    // Approve button logic inside the modal
    document.getElementById("approveBtn").addEventListener("click", function() {
        const studentId = document.getElementById("student_id").textContent;
        const studentName = document.getElementById("student_name").textContent.split(' ');
        const firstName = studentName[0];
        const lastName = studentName[1];
        const yearLevel = document.getElementById("year_level").textContent;
        const course = document.getElementById("course").textContent;
        const section = document.getElementById("section").textContent;

        // Show confirmation dialog (Yes/No)
        const isApproved = window.confirm("Are you sure you want to approve this student?");

        if (isApproved) {
            const data = {
                approve: true,
                student_id: studentId,
                firstname: firstName,
                lastname: lastName,
                year_level: yearLevel,
                course: course,
                section: section
            };

            // Use AJAX to send data to the PHP file for insertion
            fetch(window.location.href, {
                method: 'POST',
                body: new URLSearchParams(data),
            })
            .then(response => response.text())
            .then(data => {
                // Show a success alert after approval
                alert('Student has been approved and added to student status with status: Cleared.');
                location.reload(); // Reload to reflect changes
            })
            .catch(error => {
                // Show an error alert on failure
                alert('Error: ' + error);
            });
        } else {
            // If user clicked "No", cancel the approval
            alert("Student approval has been canceled.");
        }
    });

    // Decline button logic inside the modal
    document.getElementById("declineBtn").addEventListener("click", function() {
        const studentId = document.getElementById("student_id").textContent;
        const studentName = document.getElementById("student_name").textContent.split(' ');
        const firstName = studentName[0];
        const lastName = studentName[1];
        const yearLevel = document.getElementById("year_level").textContent;
        const course = document.getElementById("course").textContent;
        const section = document.getElementById("section").textContent;

        // Show confirmation dialog (Yes/No)
        const isDeclined = window.confirm("Are you sure you want to decline this student?");

        if (isDeclined) {
            const data = {
                decline: true,
                student_id: studentId,
                firstname: firstName,
                lastname: lastName,
                year_level: yearLevel,
                course: course,
                section: section
            };

            // Use AJAX to send data to the PHP file for insertion
            fetch(window.location.href, {
                method: 'POST',
                body: new URLSearchParams(data),
            })
            .then(response => response.text())
            .then(data => {
                // Show a success alert after declining
                alert('Student has been declined and added to student status with status: Not Cleared.');
                location.reload(); // Reload to reflect changes
            })
            .catch(error => {
                // Show an error alert on failure
                alert('Error: ' + error);
            });
        } else {
            // If user clicked "No", cancel the decline
            alert("Student decline has been canceled.");
        }
    });
});
</script>
