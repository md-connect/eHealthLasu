<?php
include("../security.php");
include("header.php");
include("../includes/dbconfig/dbconfig.php");
$status = "";
if (isset($_POST['btn_delete'])) {
    $staff_id = $_POST['delete_id'];
    $sql = mysqli_query($conn, "DELETE FROM staff WHERE staff_id='$staff_id'");
    if ($sql) {
        $status = "<p style='color:green; text-transformation:bold'>Record deleted successfully.</p>";
    } else {
        $status = "<p style='color:red; text-transformation:bold'>Error has occured, please try again later!</p>";
    }
}

?>
<main>
    <div class="row mt-4">
        <div class="col s12">
            <div class="row">
                <div id="admin" class="col s12">
                    <div class="card material-table">
                        <div class="table-header">
                            <?php echo $status; ?>
                            <span class="table-title">All Medical Staff Records</span>
                            <div class="actions">
                                <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
                            </div>
                        </div>
                        <table class="centered" id="datatable">
                            <?php
                            $sql = "SELECT * FROM staff";
                            $sql_run = mysqli_query($conn, $sql);

                            ?>
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>STAFF NO.</th>
                                    <th>FULL NAME</th>
                                    <th>CADRE</th>
                                    <th>GENDER</th>
                                    <th>DATE OF BIRTH</th>
                                    <th>VIEW MORE</th>
                                    <th>EDIT</th>
                                    <th>DELETE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (mysqli_num_rows($sql_run) > 0) {
                                    $count = 1;
                                    while ($row = mysqli_fetch_assoc($sql_run)) {
                                        $staff_no = $row['staff_no'];
                                ?>
                                        <tr>
                                            <td><?php echo $count ?></td>
                                            <td><?php echo strtoupper($staff_no); ?></td>
                                            <td><?php echo strtoupper($row['last_name'] . " " . $row['first_name'] . " " . $row['middle_name']); ?></td>
                                            <td><?php echo strtoupper($row['s_role']); ?></td>
                                            <td><?php echo strtoupper($row['gender']); ?></td>
                                            <td><?php echo strtoupper($row['dob']); ?></td>
                                            <td>
                                                <form action="view_a_staff.php" method="POST" class="col s12">
                                                    <div>
                                                        <input hidden name="btn_id" type="text" class="validate" value="<?php echo $row['staff_id']; ?>">
                                                        <button class="btn-flat" type="submit" name="btn_viewmore" class="white">
                                                            <i class="material-icons prefix ">remove_red_eye</i>
                                                        </button>
                                                    </div>
                                                </form>

                                            </td>
                                            <td>
                                                <form action="edit_staff_record.php" method="POST" class="col s12">
                                                    <div>
                                                        <input hidden name="staff_id" type="text" class="validate" value="<?php echo $row['staff_id']; ?>">
                                                        <button class="btn-flat" type="submit" name="edit_staff" class="white">
                                                            <i class="material-icons prefix ">edit</i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="" method="POST" class="col s12">
                                                    <div>
                                                        <input hidden name="delete_id" type="text" class="validate" value="<?php echo $row['staff_id']; ?>">
                                                        <button class="btn-flat" type="submit" name="btn_delete" class="white">
                                                            <i class="material-icons prefix red-text">delete</i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                <?php
                                        $count++;
                                    }
                                } else {
                                    echo "No Record found!";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($_POST['btn_viewmore'])) {
        echo "Tested";
    }

    ?>
    <!-- Modal Structure -->
    <div id="viewmore" class="modal modal-fixed-footer">
        <div class="modal-content">
            <?php if (isset($_POST['btn_viewmore'])) {
                echo "Tested";
            }

            ?>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Agree</a>
        </div>
    </div>
</main>


<script src="../assets/materialize/jquery.min.js"></script>
<script src="../assets/datatable/jquery.dataTables.min.js"></script>
<script src="../assets/materialize/js/materialize.min.js"></script>
<script src="../assets/datatable/buttons.html5.min.js"></script>
<script src="../assets/datatable/buttons.print.min.js"></script>
<script src="../assets/datatable/dataTables.buttons.min.js"></script>
<script src="../assets/datatable/jszip.min.js"></script>
<script src="../assets/materialize/js/materialize.js"></script>
<script src="../assets/materialize/js/script.js"></script>
<script src="../assets/datatable/script.js"></script>
<script>
    $(document).ready(function() {
        // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
        $('.modal').modal();
    });
</script>
</body>

</html>