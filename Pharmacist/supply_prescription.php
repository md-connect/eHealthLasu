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
<style>
  .bold {
    font-weight: bold;
  }
</style>

<main>
  <div class="container">
    <div class="grey lighten-4">
      <h5 class="center bold">
        DRUG DISPENSION</h5>
    </div>
  </div>
  <div class="" style="padding-left: 20px; padding-right: 20px;">
    <div class="row">
      <div class="col m6 s12 l6">
        <div class="card-panel gradient-border">
          <div class="row center">
            <div class="col s12">
              <p> <img width="100" height="200" class="" src="assets/images/md.jpg" alt="" /></p>
            </div>
            <div class="col s12">
              <p class="bold">Hospital No: <?php echo $card_no; ?></p>
            </div>
            <div class="col  s12 ">
              <p class="bold">School ID: <?php echo $identity; ?></p>
            </div>
            <div class="col  s12 ">
              <p class="bold">Name: <?php echo $fullname; ?></p>
            </div>
            <div class="col  s4">
              <p class="bold">Patient Type: <?php echo $pat_type; ?></p>
            </div>
            <div class="col  s4">
              <p class="bold">Age: <?php echo $age; ?></p>
            </div>
            <div class="col  s4">
              <p class="bold">Sex: <?php echo $gender; ?></p>
            </div>
            <div class="col  s12 ">
              <p class="bold">Presribed By: <?php echo $fullname; ?></p>
            </div>
            <div class="col  s12 ">
              <p class="bold">Presription Date: <?php echo $fullname; ?></p>
            </div>
            <div class="col  s12 ">
              <p class="bold">Presription: <?php echo $fullname; ?></p>
            </div>
          </div>
        </div>
      </div>
      <div class="col m6 s12 l6">
        <div class="card-panel gradient-border">




          <div class="row">
            <div class="">
              <form action="" class="row" method="POST">
                <div class="input-field col s12 m12 l6">
                  <input id="first_name" type="text" name="drugcode" class="validate">
                  <label for="first_name">Drug Code</label>
                </div>
                <div class="input-field col s12 m12 l6">
                  <input id="first_name" type="text" name="drugname" class="validate">
                  <label for="first_name">Drug Name</label>
                </div>
                <div class="input-field col s12">
                  <select name="drugtype">
                    <option value="" disabled selected>Choose your option</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                  </select>
                  <label>Drug Type</label>
                </div>
                <div class="input-field col s12 m12 l6">
                  <input id="first_name" type="text" name="qty" class="validate">
                  <label for="first_name">Quantity</label>
                </div>

                <div class="input-field col s12 m12 l6">
                  <input id="first_name" type="text" name="supplydate" class="datepicker validate">
                  <label for="first_name">Supply Date</label>
                </div>
                <div class="input-field col s12 m12 l12">
                  <label for="first_name">Supply By: </label>
                </div>
                <div class="input-field col s12">
                  <button name="submit" type="button" class="btn brown block darken-4">
                    ADD drug
                  </button>
                </div>
                <div class="input-field col s12">
                  <button name="submit" type="submit" class="btn blue block darken-4">
                    Dispence
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
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

    $('.datepicker').pickadate({
      selectMonths: true, // Creates a dropdown to control month
      selectYears: 15, // Creates a dropdown of 15 years to control year,
      format: 'yyyy/mm/dd',
      today: 'Today',
      clear: 'Clear',
      close: 'Ok',
      closeOnSelect: false // Close upon selecting a date,

    });
    $('.datepicker').on('mousedown', function(event) {
      event.preventDefault();
    });
  });
</script>
</body>

</html>