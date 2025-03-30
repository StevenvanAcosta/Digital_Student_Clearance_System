<?php
// Ensure database connection is set
if (!isset($conn)) {
    die("Database connection error");
}

$table = 'signatory';
$error = "";

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
?>

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
            while ($row = $result->fetch_assoc()) {
                $studentKey = $row['student_id'];
                $studentRecords[$studentKey][] = $row;
                if (!isset($displayedStudents[$studentKey])) {
                    $displayedStudents[$studentKey] = true;
                    ?>
                    <tr class="clickable-row" data-bs-toggle="modal" data-bs-target="#detailsModal"
                        data-studentkey="<?php echo htmlspecialchars($studentKey); ?>">
                        <td><?php echo htmlspecialchars($row['firstname'] . ' ' . $row['lastname']); ?></td>
                        <td><?php echo htmlspecialchars($row['year_level']); ?></td>
                        <td><?php echo htmlspecialchars($row['course']); ?></td>
                        <td><?php echo htmlspecialchars($row['section']); ?></td>
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
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
function initializeDataTable() {
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
            ">",
        "responsive": true
    });
}

// Initialize DataTable after a short delay
setTimeout(initializeDataTable, 500);

// Pass PHP data to JavaScript safely
const studentRecords = <?php echo json_encode($studentRecords, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;

document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll(".clickable-row").forEach(row => {
        row.addEventListener("click", function() {
            const studentKey = this.dataset.studentkey;
            const records = studentRecords[studentKey];

            if (records && records.length > 0) {
                const studentData = records[0];

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
});
</script>
