<?php
include("../security.php");
include("header.php");
include("../includes/dbconfig/dbconfig.php");
$status = "";
if (isset($_POST['btn_delete'])) {
  $pat_id = $_POST['delete_id'];
  $sql_run = mysqli_query($conn, "DELETE FROM patient_record WHERE pat_id='$pat_id'");
  if ($sql_run) {
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
        <?php echo $status; ?>
        <div id="admin" class="col s12">
          <div class="card material-table">
            <div class="table-header">
              <span class="table-title">All Patients Records</span>
              <div class="actions">
                <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
              </div>
            </div>
            <table class="centered responsive-table" id="datatable">
              <?php
              $sql = "SELECT * FROM patient_record ORDER BY patient_type";
              $sql_run = mysqli_query($conn, $sql);

              ?>
              <thead>
                <tr>
                  <th>HOSPITAL NO.</th>
                  <th>FULL NAME</th>
                  <th>CATEGORY</th>
                  <th>UNIQUE ID</th>
                  <th>REG. DATE</th>
                  <th>VIEW MORE</th>
                  <th>EDIT</th>
                  <th>DELETE</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (mysqli_num_rows($sql_run) > 0) {
                  while ($row = mysqli_fetch_assoc($sql_run)) {
                    $hospital_no = $row['hospital_no'];
                ?>
                    <tr>
                      <td><?php echo $hospital_no ?></td>
                      <td><?php echo $row['last_name'] . " " . $row['first_name'] . " " . $row['middle_name']; ?></td>
                      <td><?php echo $row['patient_type']; ?></td>
                      <td><?php echo $row['identity']; ?></td>
                      <td><?php echo $row['date_of_entry']; ?></td>


                      <td>
                        <form action="view_a_patient.php" method="POST" class="col s12">
                          <div>
                            <input hidden name="btn_hospital_no" type="text" class="validate" value="<?php echo $row['hospital_no']; ?>">
                            <input hidden name="btn_id" type="text" class="validate" value="<?php echo $row['pat_id']; ?>">
                            <button class="btn-flat" type="submit" name="btn_viewmore" class="white">
                              <i class="material-icons prefix ">remove_red_eye</i>
                            </button>
                          </div>
                        </form>

                      </td>
                      <td>
                        <form action="edit_patient.php" method="POST" class="col s12">
                          <div>
                            <input hidden name="edit_id" type="text" class="validate" value="<?php echo $row['pat_id']; ?>">
                            <button class="btn-flat" type="submit" name="edit_patient" class="white">
                              <i class="material-icons prefix ">edit</i>
                            </button>
                          </div>
                        </form>
                      </td>
                      <td>
                        <form action="" method="POST" class="col s12">
                          <div>
                            <input hidden name="delete_id" type="text" class="validate" value="<?php echo $row['pat_id']; ?>">
                            <button class="btn-flat" type="submit" name="btn_delete" class="white">
                              <i class="material-icons prefix red-text">delete</i>
                            </button>
                          </div>
                        </form>
                      </td>
                    </tr>
                <?php
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
    // echo "Tested";
  }

  ?>
  <!-- Modal Structure -->
  <div id="viewmore" class="modal modal-fixed-footer">
    <div class="modal-content">
      <?php if (isset($_POST['btn_viewmore'])) {
        //echo "Tested";
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
<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.0/js/materialize.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.3.1/js/buttons.print.min.js'></script>
<script src='https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js'></script> -->



<script>
  $(document).ready(function() {
    // the "href" attribute of the modal trigger must specify the modal ID that wants to be triggered
    $('.modal').modal();
  });
</script>
</body>

</html>