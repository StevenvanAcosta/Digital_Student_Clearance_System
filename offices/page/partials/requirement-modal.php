<?php
    require '../../../connect/connect.php';
    $offices_id = $_POST['officesId'];
    $requirement_id = $_POST['requirementId'];
?>
<form method="POST">
    <input type="hidden" name="offices_id" value="<?php echo $offices_id ?>">

    <!-- Filtered Select2 Dropdown -->
    <div class="mb-4">
        <label class="form-label fw-bold">Select Courses</label>
        <select id="courseSelect" class="form-select form-select-solid" data-control="select2"
                data-close-on-select="false" data-placeholder="Select courses"
                data-allow-clear="true" multiple name="courses[]">
        <?php
            // $sql = "SELECT t.*, 
            //           (SELECT name FROM courses WHERE id=t.courses_id LIMIT 1) AS name,
            //           (SELECT year_level FROM courses WHERE id=t.courses_id LIMIT 1) AS year_level,
            //           (SELECT section FROM courses WHERE id=t.courses_id LIMIT 1) AS section
            //         FROM signatory_list t
            //         WHERE offices_id='$offices_id'";
            $sql = "SELECT `p`.*, `c`.* FROM `program` `p` 
                    INNER JOIN `courses` `c` ON `p`.`courses_id`=`c`.`id`
                    WHERE `p`.`offices_id`='$offices_id'";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                extract($row);
                $label = $name . ' ' . $year_level . $section;
                ?>
                <option value="<?php echo $courses_id ?>"><?php echo $name . $year_level . $section ?></option>
                <?php
            }
            }
        ?>
        </select>
    </div>

    <!-- Save Button under selection on the right side -->
    <div class="d-flex justify-content-end mb-3">
        <button type="submit" class="btn btn-success btn-sm" name="save">Save</button>
    </div>

    <!-- Signatory Table -->
    <div class="table-responsive">
        <table class="table table-bordered">
        <thead>
            <tr>
            <th>Program</th>
            <th>Action</th>
            </tr>
        </thead>
        <tbody id="courseTableBody">
            <?php
            // Fetch courses from the program table and display them
            // $programSql = "SELECT p.*, c.name, c.year_level, c.section 
            //                 FROM program p
            //                 JOIN courses c ON p.courses_id = c.id
            //                 WHERE p.offices_id = '$offices_id'";
            $programSql = "SELECT `p`.*, `c`.* FROM `program` `p` INNER JOIN `courses` `c` ON `p`.`courses_id`=`c`.`id` WHERE `p`.`requirement_id`='$requirement_id'";

            $programResult = $conn->query($programSql);
            if ($programResult->num_rows > 0) {
                while ($programRow = $programResult->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $programRow['name'] . ' ' . $programRow['year_level'] . ' ' . $programRow['section']; ?></td>
                    <td>
                    <!-- Action column, you can add edit/delete options here -->
                    <button type="button" class="btn btn-danger btn-sm">Remove</button>
                    </td>
                </tr>
                <?php
                }
            }
            ?>
        </tbody>
        </table>
    </div>

    <!-- Footer Buttons -->
    <div class="modal-footer">
        <button type="button" class="btn btn-light btn-sm" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-sm" name="add">Set Active</button>
    </div>
</form>