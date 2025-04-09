<?php
    $table = 'courses';
    $error = "";
?>

<div class="container">
    <?php echo $error; ?>
    <!-- Student -->
    <form method="POST" enctype="multipart/form-data"> <!-- Form to handle file upload -->
        <table id="kt_datatable_dom_positioning" class="table table-striped table-row-bordered gy-5 gs-7 border rounded">
            <thead>
                <tr class="fw-bold fs-6 text-gray-800 px-7">
                    <th>Offices</th>
                    <th>Status</th>
                    <th>Signatory</th>
                    <th>Requirements</th>
                    <th>Upload</th> <!-- Upload column header -->
                    <th>Action</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT t.* 
                            FROM $table t 
                            WHERE name='$courses' 
                            AND year_level='$year_level' 
                            AND section='$section'";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            extract($row);

                            $sql = "SELECT sl.*, 
                                           (SELECT name FROM offices WHERE id=sl.offices_id) AS offices,
                                           (SELECT firstname FROM offices WHERE id=sl.offices_id) AS signatory_firstname,
                                           (SELECT lastname FROM offices WHERE id=sl.offices_id) AS signatory_lastname
                                    FROM signatory_list sl 
                                    WHERE courses_id='$id'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    extract($row);

                                    $sql2 = "SELECT * FROM signatory WHERE signatory_list_id='$offices_id' AND student_id='$user_id'";
                                    $result2 = $conn->query($sql2);

                                    $status = ($result2->num_rows > 0) ? 'Approve' : 'Pending';

                                    // Display signatory's firstname and lastname
                                    ?>
                                    <tr>
                                        <td><?php echo $offices; ?></td>
                                        <td><?php echo $status; ?></td>
                                        <td><?php echo $signatory_firstname . ' ' . $signatory_lastname; ?></td> <!-- Signatory's full name -->
                                        <td></td>
                                        <td>
                                            <input type="file" name="file_upload[]" /> <!-- Upload file input -->
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-primary">Submit</button> <!-- Submit button -->
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
    </form>
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

    setTimeout(function () {
        table();
    }, 1000);
</script>
