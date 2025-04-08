<?php
    $table = 'signatory_list';
    $error = "";

    if (isset($_GET['msg'])) {
        if ($_GET['msg'] == "sent") {
            $error = '<!--begin::Alert-->
                <div class="alert alert-info d-flex align-items-center p-5">
                    <!--begin::Icon-->
                    <i class="ki-duotone ki-shield-tick fs-2hx text-info me-4"><span class="path1"></span><span class="path2"></span></i>
                    <!--end::Icon-->

                    <!--begin::Wrapper-->
                    <div class="d-flex flex-column">
                        <!--begin::Title-->
                        <h4 class="mb-1 text-info">Success</h4>
                        <!--end::Title-->

                        <!--begin::Content-->
                        <span>Mail has been sent</span>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Alert-->';
        }
    }

    if (isset($_GET['approve'])) {
        extract($_GET);

        // Check if the student is already in the signatory table with the current user_id and student_id
        $sql = "SELECT * FROM signatory WHERE signatory_list_id='$user_id' AND student_id='$approve'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Student is already in the signatory table
            $row = $result->fetch_assoc();
            
            if ($row['status'] != 'Approved') {
                // Update the status to "Approved"
                $sql_update = "UPDATE signatory SET status='Approved' WHERE signatory_list_id='$user_id' AND student_id='$approve'";
                if ($conn->query($sql_update) === TRUE) {
                    $error = '<div class="alert alert-success d-flex align-items-center p-5">
                                <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-success">Success</h4>
                                    <span>Status has been updated to Approved.</span>
                                </div>
                            </div>';
                } else {
                    $error = '<div class="alert alert-danger d-flex align-items-center p-5">
                                <i class="ki-duotone ki-shield-tick fs-2hx text-danger me-4"><span class="path1"></span><span class="path2"></span></i>
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-danger">Error</h4>
                                    <span>Failed to update status to Approved.</span>
                                </div>
                            </div>';
                }
            } else {
                // Student is already approved
                $error = '<div class="alert alert-warning d-flex align-items-center p-5">
                            <i class="ki-duotone ki-shield-tick fs-2hx text-warning me-4"><span class="path1"></span><span class="path2"></span></i>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-warning">Already Approved</h4>
                                <span>This student is already marked as Approved.</span>
                            </div>
                        </div>';
            }
        } else {
            // If the student is not in the signatory table, insert a new entry with "Approved"
            $sql_insert = "INSERT INTO signatory (signatory_list_id, student_id, date_created, status) 
                           VALUES ('$user_id', '$approve', NOW(), 'Approved')";
            if ($conn->query($sql_insert) === TRUE) {
                $last_id = $conn->insert_id;
                $error = '<div class="alert alert-success d-flex align-items-center p-5">
                            <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-success">Success</h4>
                                <span>Signatory has been approved</span>
                            </div>
                        </div>';
            } else {
                echo "Error: " . $sql_insert . "<br>" . $conn->error;
            }
        }
    }

    // Handle Pending Button
    if (isset($_GET['pending'])) {
        extract($_GET);

        // Check if the student already has a record with Pending or Approved status
        $sql_check = "SELECT * FROM signatory WHERE signatory_list_id='$user_id' AND student_id='$pending'";
        $result_check = $conn->query($sql_check);

        if ($result_check->num_rows > 0) {
            // Update the status to Pending if it's not already "Pending"
            $row = $result_check->fetch_assoc();
            if ($row['status'] != 'Pending') {
                $sql_update = "UPDATE signatory SET status='Pending' WHERE signatory_list_id='$user_id' AND student_id='$pending'";
                if ($conn->query($sql_update) === TRUE) {
                    $error = '<div class="alert alert-info d-flex align-items-center p-5">
                                <i class="ki-duotone ki-shield-tick fs-2hx text-info me-4"><span class="path1"></span><span class="path2"></span></i>
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-info">Status Updated</h4>
                                    <span>Student has been marked as Pending.</span>
                                </div>
                            </div>';
                } else {
                    $error = '<div class="alert alert-danger d-flex align-items-center p-5">
                                <i class="ki-duotone ki-shield-tick fs-2hx text-danger me-4"><span class="path1"></span><span class="path2"></span></i>
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-danger">Error</h4>
                                    <span>Failed to update status to Pending.</span>
                                </div>
                            </div>';
                }
            } else {
                // Already Pending
                $error = '<div class="alert alert-warning d-flex align-items-center p-5">
                            <i class="ki-duotone ki-shield-tick fs-2hx text-warning me-4"><span class="path1"></span><span class="path2"></span></i>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-warning">Already Pending</h4>
                                <span>This student is already in Pending status.</span>
                            </div>
                        </div>';
            }
        } else {
            // No record found, insert a new record with Pending status
            $sql_insert = "INSERT INTO signatory SET signatory_list_id='$user_id', student_id='$pending', date_created=NOW(), status='Pending'";
            if ($conn->query($sql_insert) === TRUE) {
                $error = '<div class="alert alert-info d-flex align-items-center p-5">
                            <i class="ki-duotone ki-shield-tick fs-2hx text-info me-4"><span class="path1"></span><span class="path2"></span></i>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-info">Status Updated</h4>
                                <span>Student has been marked as Pending.</span>
                            </div>
                        </div>';
            } else {
                $error = '<div class="alert alert-danger d-flex align-items-center p-5">
                            <i class="ki-duotone ki-shield-tick fs-2hx text-danger me-4"><span class="path1"></span><span class="path2"></span></i>
                            <div class="d-flex flex-column">
                                <h4 class="mb-1 text-danger">Error</h4>
                                <span>Failed to update status to Pending.</span>
                            </div>
                        </div>';
            }
        }
    }
?>

<div class="container">
    <?php echo $error ?>
    <h1>Signatory</h1>
    <button class="btn btn-primary btn-sm" onclick="showRequirements()">Show Requirements</button>
    <table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
        <thead>
            <tr class="fw-bold fs-6 text-gray-800 px-7">
                <th>Name</th>
                <th>Program</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $sql = "SELECT t.*,
                        (SELECT name FROM courses WHERE id=t.courses_id LIMIT 1) AS name,
                        (SELECT year_level FROM courses WHERE id=t.courses_id LIMIT 1) AS year_level,
                        (SELECT section FROM courses WHERE id=t.courses_id LIMIT 1) AS section
                         FROM $table t WHERE offices_id='$user_id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        extract($row);

                        $sql1 = "SELECT * FROM student WHERE courses='$name' AND year_level='$year_level' AND section='$section'";
                        $result1 = $conn->query($sql1);

                        if ($result1->num_rows > 0) {
                            while ($row1 = $result1->fetch_assoc()) {
                                extract($row1);

                                $sql2 = "SELECT * FROM signatory WHERE signatory_list_id='$user_id' AND student_id='$id'";
                                $result2 = $conn->query($sql2);

                                if ($result2->num_rows > 0) {
                                    $row2 = $result2->fetch_assoc();
                                    $status = $row2['status']; // Use actual status from the database
                                } else {
                                    $status = 'Pending';
                                }
                                
                                ?>
                                <tr>
                                    <td><?php echo $firstname ?> <?php echo $lastname ?></td>
                                    <td><?php echo $name ?> <?php echo $year_level ?> <?php echo $section ?></td>
                                    <td><?php echo $status ?></td>
                                    <td>
                                        <a class="btn btn-light-success btn-sm" href="?page=<?php echo $page ?>&approve=<?php echo $id ?>">Approve</a>
                                        <a class="btn btn-light-warning btn-sm" href="?page=<?php echo $page ?>&pending=<?php echo $id ?>">Pending</a>
                                        <a class="btn btn-light-info btn-sm" onclick="mails('<?php echo $email ?>');" data-bs-toggle="modal" data-bs-target="#kt_modal_2"><i class="bi bi-send"></i> Mail</a>
                                    </td>
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
	 function mails(email){
	 	document.sendmail.email.value=email;
	 }
</script>

<!-- Mail MODAL -->
<div class="modal fade" tabindex="-1" id="kt_modal_2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Mailing</h3>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
                <!--end::Close-->
            </div>

            <form method="GET" action="../send-mail.php" name="sendmail">
            	<div class="modal-body">
            		<input type="hidden" name="email">
            		<input type="hidden" name="offices" value="<?php echo$user_name?>">
            		<textarea class="form-control" placeholder="Please type here" name="msg" required></textarea>
	            </div>
	            <div class="modal-footer">
	                <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
	                <button type="submit" class="btn btn-info btn-sm" name="send"><i class="bi bi-send"></i>Send</button>
	            </div>
            </form>
        </div>
    </div>
</div>








<!-- FUNCTION FOR MODAL REQUIREMENTS -->
<?php

$table = "requirements";

$success = "";
$error = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['requirement_name'])) {
    $requirement_name = $_POST['requirement_name'];

    $stmt = $conn->prepare("INSERT INTO $table (requirement_name, offices_id) VALUES (?, ?)");
    $stmt->bind_param("si", $requirement_name, $user_id);

    if ($stmt->execute()) {
        $success = "New record created successfully.";
    } else {
        $error = "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch requirements
$sql = "SELECT `requirements`.*, `offices`.`name` AS office_name 
        FROM `requirements` 
        INNER JOIN `offices` ON `requirements`.`offices_id` = `offices`.`id` 
        WHERE `requirements`.`offices_id` = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!-- MODAL -->
<div class="modal fade" id="requirementsModal" tabindex="-1" aria-labelledby="requirementsModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="requirementsModalLabel">Add Requirements</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <!-- Form to insert the requirement -->
      <form method="POST">
        <div class="modal-body">
          <?php if (!empty($success)): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <?= $success ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php elseif (!empty($error)): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <?= $error ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php endif; ?>

          <div class="mb-3">
            <label for="requirementName" class="form-label">Requirement Name</label>
            <input type="text" class="form-control" id="requirementName" name="requirement_name" required> 
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary btn-sm" name="add">Save Requirement</button>
        </div>
      </form>

      <!-- Table -->
      <div class="modal-body">
        <div style="max-height: 300px; overflow-y: auto;">
          <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
            <thead>
              <tr class="fw-bold fs-6 text-gray-800 px-7">
                <th>Name</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                      echo "<tr>";
                      echo "<td>" . htmlspecialchars($row['requirement_name']) . "</td>";
                      echo "<td><a class='btn btn-light-success btn-sm'><i class='bi bi-check'></i> Signatory List</a></td>";
                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='2'>No records found</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>

    </div>
  </div>
</div>


<!-- JavaScript to show the modal -->
<script>
  function showRequirements() {
    var modal = new bootstrap.Modal(document.getElementById('requirementsModal'));
    modal.show();
  }
</script>
