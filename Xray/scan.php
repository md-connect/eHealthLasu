<?php
include("../security.php");
include("../includes/dbconfig/dbconfig.php");
include("header.php");

$pet_date = date('Y-m-d');
$hospital_no = $_GET['hospital_no'];
$hospital_no = explode("?", $hospital_no);
$card_no = $hospital_no[0];
$id = explode("=", $hospital_no[1]);
$pat_id = $id[1];
$xray_reg_date = date("Y-m-d h:i:sa");
$xray_reg_by = $_SESSION['name'];

if ($conn) {
  $result = mysqli_query($conn, "SELECT * FROM patient_record WHERE pat_id='$pat_id' AND  hospital_no = '$card_no'");
  while ($row = mysqli_fetch_Assoc($result)) {
    $hospital_no = $row["hospital_no"];
    $identity = strtoupper($row["identity"]);
    $fname = strtoupper($row["first_name"]);
    $mname = strtoupper($row["middle_name"]);
    $lname = strtoupper($row["last_name"]);
    $passport = $row['passport'];
    $gender = strtoupper($row['gender']);
    $dob = $row['dob'];
    $age = floor(((time() - strtotime($dob))  / (3600 * 24 * 365)));
    $pat_type = $row["patient_type"];
    $fullname = "$lname $fname $mname";
    $fullname = strtoupper($fullname);
    $genotype = $row['genotype'];
    $blood_group = $row['blood_group'];
  }
  if (isset($_POST['submit'])) {
    $xray_no = $_POST['xray_no'];
    $t_diagnosis = $_POST['t_diagnosis'];
    $exam_req = $_POST['exam_req'];
    $size = $_POST['size'];
    $prev_xray = $_POST['prev_xray'];
    $operationOption = $_POST['operationOption'];
    $radiographer_comment = $_POST['radiographer_comment'];
    $radiologist_report = $_POST['radiologist_report'];

    $query_test = "INSERT INTO xray(hospital_no, identity, first_name, middle_name, last_name, xray_no, tentative_diagnosis, examination_requested, size, previous_xray, operation, radiographer_comment, radiologist_report, xray_reg_by, xray_reg_date, xray_upd_by, xray_upd_date) 
                VALUES ('$card_no', '$identity', '$fname', '$mname', '$lname', '$xray_no', '$t_diagnosis', '$exam_req', '$size', '$prev_xray', '$operationOption', '$radiographer_comment', '$radiologist_report', '$xray_reg_by', '$xray_reg_date', '$xray_reg_by', '$xray_reg_date')";

    $result_test = mysqli_query($conn, $query_test) or die(mysqli_error($conn));
    if ($result_test) {
      ?>
      <script>
        alert("Patient Scan detail uploaded succesfully! Click OK to continue");
        //window.location.assign("index.php");
      </script>
    <?php
        } else {
          ?>
      <script>
        alert("Error has occured, Please try later! Click OK to continue");
        window.location.assign("tests.php");
      </script>
<?php    }
  }
}
?>

<main>
  <div class="container grey lighten-4 block">
    <h5 style="text-align: center; font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;">
      REQUEST FOR RADIOLOGICAL INVESTIGATION</h5>
  </div>
  <div class="" style="padding-left: 20px; padding-right: 20px;">
    <div class="card-panel gradient-border">
      <div class="row">
        <div class="col m12 s12 l3">
          <p>Hospital No: <?php echo $card_no; ?></p>
        </div>
        <div class="col m12 s12 l3">
          <p>School ID: <?php echo $identity; ?></p>
        </div>
        <div class="col m12 s12 l6">
          <p>Name: <?php echo $fullname; ?></p>
        </div>
        <div class="col m12 s12 l3">
          <p>Patient Type: <?php echo $pat_type; ?></p>
        </div>
        <div class="col m12 s12 l3">
          <p>Age: <?php echo $age; ?></p>
        </div>
        <div class="col m12 s12 l3">
          <p>Sex: <?php echo $gender; ?></p>
        </div>

      </div>


      <div class="container">

      </div>
      <div class="divider"></div>
      <div class="row">
        <div class="">
          <form action="" method="POST" <div class="row">
            <div class="input-field col s12 l2">
              <input type="text" name="xray_no" id="" />
              <label for="">X-Ray No</label>
            </div>

            <div class="input-field col s12 l2">
              <input type="text" name="t_diagnosis" id="t_diagnosis" />
              <label for="t_diagnosis">Tentative Diagnosis</label>
            </div>

            <div class="input-field col s12 l2">
              <input type="text" name="exam_req" id="exam_req" />
              <label for="exam_req">Examination Requested</label>
            </div>

            <div class="input-field col s12 l2">
              <select name="size">
                <option value="" disabled selected>Choose your option</option>
                <option value="25*43">25*43</option>
                <option value="35*35">35*35</option>
                <option value="40*30">40*30</option>
              </select>
              <label>Size</label>
            </div>

            <div class="input-field col s12 l2">
              <select name="prev_xray">
                <option value="" disabled selected>Choose your option</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
              <label>Previous X-Ray?</label>
            </div>
            <div class="input-field col s12 l2">
              <select name="operationOption">
                <option value="" disabled selected>Choose your option</option>
                <option value="yes">Yes</option>
                <option value="no">No</option>
              </select>
              <label>Any Operation?</label>
            </div>

            <div class="input-field col s12 l6">
              <textarea name="radiographer_comment" id="textarea1" class="materialize-textarea"></textarea>
              <label for="radiographer_comment">Radiographer's Comment</label>
            </div>
            <div class="input-field col s12 l6">
              <textarea name="radiologist_report" id="textarea1" class="materialize-textarea"></textarea>
              <label for="radiologist_report">Radiologist Report</label>
            </div>


        </div>


      </div>
      <div class="input-field">
        <button name="submit" type="submit" class="btn  blue darken-4 right">
          Submit Scan Details
        </button>
      </div>

      </form>
    </div>
  </div>
  </div>

</main>

<footer></footer>

<style>
  .parallax-container {
    height: 300px;
  }

  .nmt {
    margin-top: -20vh;
  }
</style>

<script src="../assets/materialize/js/jquery.js"></script>
<script src="../assets/materialize/js/materialize.js"></script>
<script src="../assets/materialize/js/script.js"></script>
<script>
  $(document).ready(function() {
    $('.parallax').parallax();
  });
</script>
</body>

</html>