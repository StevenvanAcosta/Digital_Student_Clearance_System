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
$table = 'signatory_list';
$error = "";

// Check for messages
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == "sent") {
        $error = '<!--begin::Alert-->
            <div class="alert alert-info alert-dismissible fade show p-5" id="auto-close-alert">
                <i class="ki-duotone ki-shield-tick fs-2hx text-info me-4"><span class="path1"></span><span class="path2"></span></i>
                <div class="d-flex flex-column">
                    <h4 class="mb-1 text-info">Success</h4>
                    <span>Mail has been sent</span>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <!--end::Alert-->';
    }
}

// Approve or Pending action
if (isset($_GET['approve']) || isset($_GET['pending'])) {
    extract($_GET);

    // Determine the status based on the clicked button
    if (isset($approve)) {
        $status = 'approve';
        $student_ids = explode(',', $approve);  // Multiple student IDs
    } elseif (isset($pending)) {
        $status = 'Pending';
        $student_ids = explode(',', $pending);  // Multiple student IDs
    }

    foreach ($student_ids as $student_id) {
        // Check if the record already exists
        $sql = "SELECT * FROM signatory WHERE signatory_list_id='$user_id' AND student_id='$student_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // If record exists, update the status
            $sql = "UPDATE signatory SET status='$status' WHERE signatory_list_id='$user_id' AND student_id='$student_id'";
            if ($conn->query($sql) === TRUE) {
                $message = ($status === 'approve') ? 'Signatory has been approved' : 'Signatory has been set to pending';
                $error = '<!--begin::Alert-->
                    <div class="alert alert-success alert-dismissible fade show p-5" id="auto-close-alert">
                        <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>
                        <div class="d-flex flex-column">
                            <h4 class="mb-1 text-success">Success</h4>
                            <span>' . $message . '</span>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <!--end::Alert-->';
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            // If no record exists, insert a new record with the selected status
            $sql = "INSERT INTO signatory SET signatory_list_id='$user_id', student_id='$student_id', date_created=NOW(), status='$status'";
            if ($conn->query($sql) === TRUE) {
                $message = ($status === 'approve') ? 'Signatory has been approved' : 'Signatory has been set to pending';
                $error = '<!--begin::Alert-->
                    <div class="alert alert-success alert-dismissible fade show p-5" id="auto-close-alert">
                        <i class="ki-duotone ki-shield-tick fs-2hx text-success me-4"><span class="path1"></span><span class="path2"></span></i>
                        <div class="d-flex flex-column">
                            <h4 class="mb-1 text-success">Success</h4>
                            <span>' . $message . '</span>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <!--end::Alert-->';
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}
?>

<div class="container">
    <?php echo $error ?>
    
    <!-- Search input -->
    <div class="mb-3 d-flex justify-content-end">
        <input type="text" id="searchInput" class="form-control w-25" placeholder="Search students...">
    </div>


    <!-- Signatory Table -->
    <table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
        <thead>
            <tr class="fw-bold fs-6 text-gray-800 px-7">
                <th><input type="checkbox" id="select-all"></th> <!-- Select All checkbox -->
                <th>Name</th>
                <th>Program</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="tableBody">
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
                                $status = $result2->fetch_assoc()['status']; // Fetch current status
                            } else {
                                $status = 'Pending';
                            }
                            ?>
                            <tr class="table-row">
                                <td><input type="checkbox" class="select-student" value="<?php echo $id; ?>"></td> <!-- Individual selection checkbox -->
                                <td><?php echo $firstname ?> <?php echo $lastname ?></td>
                                <td><?php echo $name ?> <?php echo $year_level ?> <?php echo $section ?></td>
                                <td><?php echo $status ?></td>
                                <td>
                                    <a class="btn btn-light-success btn-sm approve-btn" href="javascript:void(0);" data-id="<?php echo $id ?>">Approve</a>
                                    <a class="btn btn-light-warning btn-sm pending-btn" href="javascript:void(0);" data-id="<?php echo $id ?>">Pending</a>
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
    // Select All functionality
    document.getElementById('select-all').addEventListener('change', function() {
        let checkboxes = document.querySelectorAll('.select-student');
        checkboxes.forEach(checkbox => checkbox.checked = this.checked);
    });

    // Approve selected students
    document.querySelectorAll('.approve-btn').forEach(button => {
        button.addEventListener('click', function() {
            let selectedIds = [];
            document.querySelectorAll('.select-student:checked').forEach(checkbox => {
                selectedIds.push(checkbox.value);
            });

            if (selectedIds.length > 0) {
                window.location.href = '?page=<?php echo $page ?>&approve=' + selectedIds.join(',');
            } else {
                alert('Please select at least one student to approve.');
            }
        });
    });

    // Set selected students to pending
    document.querySelectorAll('.pending-btn').forEach(button => {
        button.addEventListener('click', function() {
            let selectedIds = [];
            document.querySelectorAll('.select-student:checked').forEach(checkbox => {
                selectedIds.push(checkbox.value);
            });

            if (selectedIds.length > 0) {
                window.location.href = '?page=<?php echo $page ?>&pending=' + selectedIds.join(',');
            } else {
                alert('Please select at least one student to set as pending.');
            }
        });
    });

    function mails(email) {
        document.sendmail.email.value = email;
    }

    // Filter rows based on search input
    document.getElementById('searchInput').addEventListener('input', function() {
        let searchValue = this.value.toLowerCase();
        let rows = document.querySelectorAll('#tableBody .table-row');

        rows.forEach(row => {
            let name = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            let program = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            let status = row.querySelector('td:nth-child(4)').textContent.toLowerCase();

            if (name.includes(searchValue) || program.includes(searchValue) || status.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });

    // Auto close the alert after 3 seconds
    document.addEventListener('DOMContentLoaded', function () {
        var alert = document.getElementById('auto-close-alert');
        if (alert) {
            setTimeout(function () {
                var closeButton = alert.querySelector('.btn-close');
                if (closeButton) {
                    closeButton.click();
                }
            }, 3000); // 3000 ms = 3 seconds
        }
    });
</script>

<div class="modal fade" tabindex="-1" id="kt_modal_2">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title">Mailing</h3>
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span class="path2"></span></i>
                </div>
            </div>

            <form method="GET" action="../send-mail.php" name="sendmail">
                <div class="modal-body">
                    <input type="hidden" name="email">
                    <input type="hidden" name="offices" value="<?php echo $user_name ?>">
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
